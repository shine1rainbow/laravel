<?php

namespace App\Jobs\Backend\Menu;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Tables\Menu;
use App\Tables\MenuOption;
use App\Tables\MenuAddition;
use stdClass;

class DestroyJob
{
    use Dispatchable, Queueable;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id)
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
        $menu = Menu::find($this->id);

        if (empty($menu)) {

            $response = [
                'code' => trans('pheicloud.response.notExist.code'),
                'msg' => trans('pheicloud.response.notExist.msg'),
                'data' => new stdClass(),
            ];

            return response()->json($response);
        }

        $menu->delete();

        //删除关联数据
        MenuAddition::where('menu_id', '=', $this->id)->delete();
        MenuOption::where('menu_id', '=', $this->id)->delete();

        $response = [
            'code' => trans('pheicloud.response.success.code'),
            'msg' => trans('pheicloud.response.success.msg'),
            'data' => new stdClass(),
        ];

        return response()->json($response);
    }
}
