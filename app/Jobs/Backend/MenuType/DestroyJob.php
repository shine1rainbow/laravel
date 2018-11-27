<?php

namespace App\Jobs\Backend\MenuType;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Tables\MenuType;
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
        $menuType = MenuType::find($this->id);

        if (empty($menuType)) {

            $response = [
                'code' => trans('pheicloud.response.notExist.code'),
                'msg' => trans('pheicloud.response.notExist.msg'),
                'data' => new stdClass(),
            ];

            return response()->json($response);
        }

        $menuType->delete();

        $response = [
            'code' => trans('pheicloud.response.success.code'),
            'msg' => trans('pheicloud.response.success.msg'),
            'data' => new stdClass(),
        ];

        return response()->json($response);
    }
}
