<?php

namespace App\Jobs\Backend\Shop;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Cache;
use App\Repositories\FloorRepository; 
use stdClass;

class GetListByFloorIdJob
{
    use Dispatchable, Queueable;

    /**
     * FloorId
     *
     * @var int
     */
    private $floor_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $floor_id)
    {
        $this->floor_id = $floor_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(FloorRepository $floorRepo)
    {
        //check cache if exist return
        $res = getDataFromCache('floor_' . $this->floor_id . '_shoplist');

        if (!is_null($res)) {
            return $res;
        }

        $shops = $floorRepo->getShopListByFloorId($this->floor_id);

        if (is_null($shops)) {

            $response = [
                'code' => trans('pheicloud.response.empty.code'),
                'msg' => trans('pheicloud.response.empty.msg'),
                'data' => new stdClass,
            ];

            return response()->json($response);

        }

        $shops = $shops->toArray();

        $filterShops = [];

        foreach ($shops as $shop) {
            $filterShops[] = array_except($shop, 'shape');
        }

        //put building_{id}_shoplist to cache
        Cache::put('floor_' . $this->floor_id . '_shoplist', $filterShops, \CACHE_MID);
        
        $response = [
            'code' => trans('pheicloud.response.success.code'),
            'msg' => trans('pheicloud.response.success.msg'),
            'data' => $filterShops,
        ];

        return response()->json($response);
    }
}
