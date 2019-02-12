<?php

namespace App\Jobs\Api\V1\Shop;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Tables\Shop;
use stdClass;

class RecommendJob
{
    use Dispatchable, Queueable;

    private $city_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($city_id)
    {
        $this->city_id = $city_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (is_null($this->city_id)) {

            $shops = Shop::where('is_recommend', '=', 1)
                ->get()
                ->toArray();

        } else {

            $shops = Shop::where([
                ['is_recommend', '=', 1],
                ['city_id', '=', $this->city_id]
            ])->get()
            ->toArray();

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
