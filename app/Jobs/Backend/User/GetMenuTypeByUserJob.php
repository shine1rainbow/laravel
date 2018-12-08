<?php

namespace App\Jobs\Backend\User;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Tables as TablesModels;

class GetMenuTypeByUserJob
{
    use Dispatchable, Queueable;

    /**
     * 认证用户
     */
    private $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(TablesModels\User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     
     * @return void
     */
    public function handle()
    {
        $shopIds = $this->user->shops()->pluck('id');

        if (is_null($shopIds)) {

            $response = [
                'code' => trans('pheicloud.response.empty.code'),
                'msg' => trans('pheicloud.response.empty.msg'),
            ];

            return response()->json($response);
        }

        $menuTypes = TablesModels\MenuType::join('shops', 'menu_types.shop_id', '=', 'shops.id')
            ->select('menu_types.*', 'shops.restaurant_name as shop_name')
            ->whereIn('shop_id', $shopIds)->get();

        $response = [
            'code' => trans('pheicloud.response.success.code'),
            'msg' => trans('pheicloud.response.success.msg'),
            'data' => $menuTypes
        ];

        return response()->json($response);
    }
}
