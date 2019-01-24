<?php

namespace App\Jobs\Api\V1\Menu;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Tables\Menu;
use stdClass;

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
        $menus = Menu::join('menu_additions', 'menus.id', '=', 'menu_additions.menu_id')
            ->join('menu_options', 'menus.id', '=', 'menu_options.menu_id')
            ->select(
                'menus.*',
                'menu_options.name as menu_options_name', 'menu_options.info as menu_options_info',
                'menu_options.introduction as menu_options_introduction', 'menu_additions.introduction as menu_additions_introduction',
                'menu_additions.name as menu_additions_name', 'menu_additions.info as menu_additions_info'
            )->get();

        if (is_null($menus)) {

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
            'data' => $menus,
        ];

        return response()->json($response);
    }
}
