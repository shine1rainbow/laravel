<?php

namespace App\Jobs\Backend\Shop;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Cache;
use App\Tables\Shop;

class IndexJob
{
    use Dispatchable, Queueable;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //check cache if exist return
        $res = getDataFromCache('shoplist');

        if (!is_null($res)) {
            return $res;
        }

        $shops = Shop::select('id', 'name', 'floor_id', 'gid')->get();

        if (is_null($shops)) {

            $response = [
                'code' => trans('pheicloud.response.empty.code'),
                'msg' => trans('pheicloud.response.empty.msg'),
                'data' => new stdClass,
            ];

            return response()->json($response);

        }
        
        //put shoplist to cache
        Cache::put('shoplist', $shops, \CACHE_MID);

        $response = [
            'code' => trans('pheicloud.response.success.code'),
            'msg' => trans('pheicloud.response.success.msg'),
            'data' => $shops,
        ];

        return response()->json($response);
    }
}
