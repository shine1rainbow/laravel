<?php

namespace App\Jobs\Backend\MenuCategory;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Tables\MenuCategory;
use App\Tables\Menu;
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
        $menuCategory = MenuCategory::find($this->id);

        if (empty($menuCategory)) {

            $response = [
                'code' => trans('pheicloud.response.notExist.code'),
                'msg' => trans('pheicloud.response.notExist.msg'),
                'data' => new stdClass(),
            ];

            return response()->json($response);
        }

        $menuCategory->delete();

        //关联删除
        Menu::where('menu_category_id', '=', $this->id)->delete();

        $response = [
            'code' => trans('pheicloud.response.success.code'),
            'msg' => trans('pheicloud.response.success.msg'),
            'data' => new stdClass(),
        ];

        return response()->json($response);
    }
}
