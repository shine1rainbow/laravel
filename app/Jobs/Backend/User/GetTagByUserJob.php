<?php

namespace App\Jobs\Backend\User;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Tables as TablesModels;

class GetTagByUserJob
{
    use Dispatchable, Queueable;

    /**
     * 认证用户
     */
    private $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(TablesModels\User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $userId = $this->user->id;

        if (is_null($userId)) {

            $response = [
                'code' => trans('pheicloud.response.empty.code'),
                'msg' => trans('pheicloud.response.empty.msg'),
            ];

            return response()->json($response);
        }

        $tags = TablesModels\Tag::where('user_id', $userId)->get();

        $response = [
            'code' => trans('pheicloud.response.success.code'),
            'msg' => trans('pheicloud.response.success.msg'),
            'data' => $tags
        ];

        return response()->json($response);
    }
}
