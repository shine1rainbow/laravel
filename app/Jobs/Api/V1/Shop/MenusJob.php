<?php

namespace App\Jobs\Api\V1\Shop;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Tables\Shop;
use App\Tables\MenuType;
use Carbon\Carbon;
use stdClass;

class MenusJob
{
    use Dispatchable, Queueable;

    private $id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $menuTypes = optional(Shop::find($this->id))->menuTypes;

        if (is_null($menuTypes)) {

            $response = [
                'code' => trans('pheicloud.response.empty.code'),
                'msg' => trans('pheicloud.response.empty.msg'),
                'data' => new stdClass,
            ];

            return response()->json($response);

        }

        foreach ($menuTypes as &$menuType) {
            $menuCategories = optional(MenuType::find($menuType['id']))->menuCategories;
            $menus = optional(MenuType::find($menuType['id']))->menus;
            $menuType['menuCategories'] = $menuCategories;
            $menuType['menus'] = $menus;
        }

        $response = [
            'code' => trans('pheicloud.response.success.code'),
            'msg' => trans('pheicloud.response.success.msg'),
            'data' => $menuTypes,
        ];

        return response()->json($response);
    }
}
