<?php

namespace App\Jobs\Backend\Shop;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Tables\Shop;
use Carbon\Carbon;

class UploadImageJob
{
    use Dispatchable, Queueable;

    //字段类型
    private $type;
    //Img路径
    private $path;
    //店铺ID
    private $id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id, $type, $path)
    {
        $this->id = $id;
        $this->type = $type;
        $this->path = $path;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $shops = Shop::where('id', '=', $this->id)
            ->update([$this->type => $this->path]);

        if (is_null($shops)) {

            $response = [
                'code' => trans('pheicloud.response.empty.code'),
                'msg' => trans('pheicloud.response.empty.msg'),
                'data' => new stdClass,
            ];

            return response()->json($response);

        }

        foreach ($shops as &$shop) {
            $shop['human_time'] = Carbon::parse($shop['created_at'])->diffForHumans();
        }
        
        $response = [
            'code' => trans('pheicloud.response.success.code'),
            'msg' => trans('pheicloud.response.success.msg'),
            'data' => $shops,
        ];

        return response()->json($response);
    }
}
