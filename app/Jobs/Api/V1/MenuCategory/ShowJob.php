<?php

namespace App\Jobs\Api\V1\MenuCategory;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Tables\MenuCategory;
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
        $menuCategory = MenuCategory::find($this->id);

        if (is_null($menuCategory)) {

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
            'data' => $menuCategory,
        ];

        return response()->json($response);
    }
}