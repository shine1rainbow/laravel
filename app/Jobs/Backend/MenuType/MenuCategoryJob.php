<?php

namespace App\Jobs\Backend\MenuType;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Tables as TablesModels;

class MenuCategoryJob
{
    use Dispatchable, Queueable;

    /**
     * menutype
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
     
     * @return void
     */
    public function handle()
    {
        if (is_null($this->id)) {

            $response = [
                'code' => trans('pheicloud.response.empty.code'),
                'msg' => trans('pheicloud.response.empty.msg'),
            ];

            return response()->json($response);
        }

        $menuCategories = TablesModels\MenuCategory::where('menu_type_id', $this->id)->get()->toArray();

        $response = [
            'code' => trans('pheicloud.response.success.code'),
            'msg' => trans('pheicloud.response.success.msg'),
            'data' => $menuCategories
        ];

        return response()->json($response);
    }
}
