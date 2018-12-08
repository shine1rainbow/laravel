<?php

namespace App\Jobs\Backend\User;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Tables as TablesModels;

class GetMenuByUserJob
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

        $menuTypeIds = TablesModels\MenuType::whereIn('shop_id', $shopIds)->pluck('id');

        if (is_null($menuTypeIds)) {

            $response = [
                'code' => trans('pheicloud.response.empty.code'),
                'msg' => trans('pheicloud.response.empty.msg'),
            ];

            return response()->json($response);
        }

        $menus = TablesModels\MenuCategory::join('menus', 'menu_categories.id', '=', 'menus.menu_category_id')
            ->select('menus.*', 'menu_categories.name as _menu_category_name')
            ->whereIn('menu_type_id', $menuTypeIds)->get();

        $response = [
            'code' => trans('pheicloud.response.success.code'),
            'msg' => trans('pheicloud.response.success.msg'),
            'data' => $menus
        ];

        return response()->json($response);
    }
}
