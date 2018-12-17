<?php

namespace App\Jobs\Backend\Menu;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Tables\Menu;
use stdClass;

class ShowJob
{
    use Dispatchable, Queueable;

    /**
     * shopId
     *
     * @var int
     */
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
        $menu = Menu::leftjoin('menu_additions', 'menus.id', '=', 'menu_additions.menu_id')
            ->leftjoin('menu_options', 'menus.id', '=', 'menu_options.menu_id')
            ->select(
                'menus.*',
                'menu_options.name as menu_options_name', 'menu_options.info as menu_options_info',
                'menu_options.introduction as menu_options_introduction', 'menu_additions.name as menu_additions_name'
            )->find($this->id);

        if (is_null($menu)) {

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
            'data' => $menu,
        ];

        return response()->json($response);
    }
}
