<?php

namespace App\Jobs\Backend\User;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Tables as TablesModels;

class GetMenuCategoryByUserJob
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

        $menuCategories = TablesModels\MenuType::join('menu_categories', 'menu_types.id', '=', 'menu_categories.menu_type_id')
            ->join('shops', 'menu_types.shop_id', '=', 'shops.id')
            ->select('menu_categories.*', 'menu_types.name as menu_type_name', 'shops.restaurant_name as shop_name')
            ->whereIn('shop_id', $shopIds)->get();

        if (is_null($menuCategories)) {

            $response = [
                'code' => trans('pheicloud.response.empty.code'),
                'msg' => trans('pheicloud.response.empty.msg'),
            ];

            return response()->json($response);
        }

        $response = [
            'code' => trans('pheicloud.response.success.code'),
            'msg' => trans('pheicloud.response.success.msg'),
            'data' => $menuCategories
        ];

        return response()->json($response);
    }
}
