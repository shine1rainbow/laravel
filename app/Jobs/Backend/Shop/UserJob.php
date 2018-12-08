<?php

namespace App\Jobs\Backend\Shop;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Tables\Shop;
use App\Tables\User;
use Carbon\Carbon;

class UserJob
{
    use Dispatchable, Queueable;

    private $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
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
        $shopIds = $this->user->shops()->pluck('id');

        $shops = Shop::join('shop_statuses', 'shops.shop_status_id', '=', 'shop_statuses.id')
            ->select('shops.*', 'shop_statuses.name as shop_status_name')
            ->whereIn('shops.id', $shopIds)
            ->get();

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
