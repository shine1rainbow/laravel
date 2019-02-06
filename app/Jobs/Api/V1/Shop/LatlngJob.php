<?php

namespace App\Jobs\Api\V1\Shop;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Tables\Shop;
use App\Tables\ShopTag;
use App\Tables\City;
use Carbon\Carbon;
use stdClass;

class LatlngJob
{
    use Dispatchable, Queueable;

    private $fromPos;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $fromPos)
    {
        $this->fromPos = $fromPos;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $cities = City::get();

        if (empty($cities)) {

            $response = [
                'code' => trans('pheicloud.response.empty.code'),
                'msg' => trans('pheicloud.response.empty.msg'),
                'data' => new stdClass,
            ];

            return response()->json($response);
        }

        $temp = 100;
        $cityId = 0;

        foreach($cities as $city) {
            $toPos = [$city['lat'], $city['lng']];
            $distance = getDistance($this->fromPos, $toPos, true, 2);
            if ($distance < 10 && $distance < $temp) {
                $temp = $distance;
                $cityId = $city['id'];
            }
        }

        if (empty($cityId)) {

            $response = [
                'code' => trans('pheicloud.response.empty.code'),
                'msg' => trans('pheicloud.response.empty.msg'),
                'data' => new stdClass,
            ];

            return response()->json($response);

        }

        $shops = Shop::leftJoin('shop_tags', 'shops.shop_tag_id', '=', 'shop_tags.id')
            ->select('shops.*', 'shop_tags.name as shop_type')
            ->where('city_id', '=', $cityId)
            ->groupBy('shop_type', 'id')
            ->get()
            ->toArray();

        if (is_null($shops)) {

            $response = [
                'code' => trans('pheicloud.response.empty.code'),
                'msg' => trans('pheicloud.response.empty.msg'),
                'data' => new stdClass,
            ];

            return response()->json($response);

        }
        
        $response = [
            'code' => trans('pheicloud.response.success.code'),
            'msg' => trans('pheicloud.response.success.msg'),
            'data' => $shops,
        ];

        return response()->json($response);
    }
}
