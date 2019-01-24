<?php

namespace App\Jobs\Api\V1\Follow;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Tables\Follow;
use stdClass;

class OperateJob
{
    use Dispatchable, Queueable;

    private $open_id;
    private $shop_id;
    private $type;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $params)
    {
        $this->type = $params['type'];
        $this->open_id = $params['open_id'];
        $this->shop_id = $params['shop_id'];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->type == 'follow') {

            //do follow
            $follow = Follow::create([
                'open_id' => $this->open_id,
                'shop_id' => $this->shop_id
            ]);

        } else {

            //do unfollow
            $follow = Follow::where([
                ['open_id', '=', $this->open_id],
                ['shop_id', '=', $this->shop_id]
            ])->first();

            if (is_null($follow)) {

                $response = [
                    'code' => trans('pheicloud.response.empty.code'),
                    'msg' => trans('pheicloud.response.empty.msg'),
                    'data' => new stdClass,
                ];

                return response()->json($response);
            }

            $follow->delete();
        }

        $response = [
            'code' => trans('pheicloud.response.success.code'),
            'msg' => trans('pheicloud.response.success.msg'),
        ];

        return response()->json($response);
    }
}
