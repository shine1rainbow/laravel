<?php

namespace App\Jobs\Api\V1\MenuType;

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
        $menuTypes = MenuType::join('shops', 'menu_types.shop_id', '=', 'shops.id')
            ->select('menu_types.*', 'shops.restaurant_name as shop_name')
            ->get();

        if (is_null($menuTypes)) {

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
            'data' => $menuTypes,
        ];

        return response()->json($response);
    }
}
