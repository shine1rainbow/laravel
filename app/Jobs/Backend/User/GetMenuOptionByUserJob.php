<?php

namespace App\Jobs\Backend\User;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Tables as TablesModels;

class GetMenuOptionByUserJob
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

        $menuCategoryIds = TablesModels\MenuCategory::whereIn('menu_type_id', $menuTypeIds)->pluck('id');

        $menuIds = TablesModels\Menu::whereIn('menu_category_id', $menuCategoryIds)->pluck('id');

        $menuOptions = TablesModels\MenuOption::join('menus', 'menu_options.menu_id', '=', 'menus.id')
            ->select('menu_options.*', 'menus.menu_name', 'menus.menu_no', 'menus.avater', 'menus.price')
            ->whereIn('menu_options.menu_id', $menuIds)->get();

        $response = [
            'code' => trans('pheicloud.response.success.code'),
            'msg' => trans('pheicloud.response.success.msg'),
            'data' => $menuOptions
        ];

        return response()->json($response);
    }
}
