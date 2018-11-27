<?php

namespace App\Jobs\Backend\MenuType;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Tables\MenuType;

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
        $shops = MenuType::join('shop_statuses', 'shops.shop_status_id', '=', 'shop_statuses.id')
            ->select('shops.*', 'shop_statuses.name as shop_status_name')
            ->get();

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
