<?php

namespace App\Jobs\Api\V1\Follow;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Tables\Follow;
use App\Tables\Shop;
use stdClass;

class IndexJob
{
    use Dispatchable, Queueable;

    private $open_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $params)
    {
        $this->open_id = isset($params['open_id']) ? $params['open_id'] : '';
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $shopIds = Follow::where('open_id', '=', $this->open_id)->pluck('shop_id')->toArray();

        $shops = Shop::whereIn('id', $shopIds)->get();

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
