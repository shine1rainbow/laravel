<?php

namespace App\Jobs\Api\V1\ShopTag;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Tables\Shop;
use stdClass;

class ShopJob
{
    use Dispatchable, Queueable;

    private $id;
    private $city_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($params)
    {
        $this->id = $params['id'];
        $this->city_id = $params['city_id'];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (is_null($this->city_id)) {

            $shops = Shop::where('shop_tag_id', '=', $this->id)->get();

        } else {

            $shops = Shop::where([
                ['shop_tag_id', '=', $this->id],
                ['city_id', '=', $this->city_id],
            ])->get();

        }

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
