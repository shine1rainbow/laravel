<?php

namespace App\Jobs\Backend\Tag;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Tables as TableModels;

class StoreJob
{
    use Dispatchable, Queueable;

    /**
     * @var string $params
     */
    private $params;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $params)
    {
        $this->params = $params;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $tag = TableModels\Tag::where('name', '=', $this->params['name'])->first();

        if (!is_null($tag)) {

            $response = [
                'code' => trans('pheicloud.response.exist.code'),
                'msg' => trans('pheicloud.response.exist.msg'),
            ];

            return response()->json($response);
        }

        $tag = TableModels\Tag::insert($this->params);

        if ($tag) {
            $code = trans('pheicloud.response.success.code');
            $msg = trans('pheicloud.response.success.msg');
        } else {
            $code = trans('pheicloud.response.error.code');
            $msg = trans('pheicloud.response.error.msg');
        }

        $response = [
            'code' => $code,
            'msg' => $msg,
        ];

        return response()->json($response);
    }
}
