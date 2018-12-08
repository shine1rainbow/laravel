<?php

namespace App\Jobs\Backend\Tag;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Tables as TablesModels;

class UserListJob
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
        $tags = $this->user->tags()->select('id', 'name', 'desc', 'created_at')->get();

        $response = [
            'code' => trans('pheicloud.response.success.code'),
            'msg' => trans('pheicloud.response.success.msg'),
            'data' => [
                'tableData' => $tags,
                'tableTitles' => [
                    [
                        'prop' => "id",
                        'label' =>  "序号",
                    ], [
                        'prop' => "name",
                        'label' =>  "标签名称",
                    ], [
                        'prop' => "desc",
                        'label' =>  "标签描述",
                    ], [
                        'prop' => "created_at",
                        'label' =>  "创建时间",
                    ]
                ],
            ]
        ];

        return response()->json($response);
    }
}
