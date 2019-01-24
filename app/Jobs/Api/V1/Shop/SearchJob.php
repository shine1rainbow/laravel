<?php

namespace App\Jobs\Api\V1\Shop;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Tables\Shop;
use App\Tables\Menu;
use App\Tables\MenuCategory;
use App\Tables\MenuType;
use Carbon\Carbon;
use stdClass;

class SearchJob
{
    use Dispatchable, Queueable;

    private $keyword;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $keyword)
    {
        $this->keyword = $keyword;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //店铺名称关键字
        $shops = Shop::select('id', 'restaurant_name as name')
            ->where('restaurant_name', 'like', "%$this->keyword%")
            ->get()
            ->toArray();

        $menuCategoryIds = Menu::where('menu_name', 'like', "%$this->keyword%")->pluck('menu_category_id');

        if (!empty($menuCategoryIds)) {

            $menuTypeIds = MenuCategory::whereIn('id', $menuCategoryIds)->pluck('menu_type_id');

            if (! empty($menuTypeIds)) {

                $shopIds = MenuType::whereIn('id', $menuTypeIds)->pluck('shop_id');

                if (!empty($shopIds)) {

                    $shopsByMenuName = Shop::select('id', 'restaurant_name as name')
                        ->whereIn('id', $shopIds)
                        ->get()
                        ->toArray();
                }
            }
        }

        $shopArr = array_merge($shops, $shopsByMenuName); 

        if (is_null($shopArr)) {

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
            'data' => $shopArr,
        ];

        return response()->json($response);
    }
}
