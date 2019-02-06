<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\Api\V1\Shop as ShopJobs;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = $this->dispatch(new ShopJobs\IndexJob());
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $response = $this->dispatch(new ShopJobs\ShowJob($id));
        return $response;
    }

    /**
     * Show shop MenuTypes
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function menutypes(int $id)
    {
        $response = $this->dispatch(new ShopJobs\MenuTypesJob($id));
        return $response;
    }

    /**
     * Show shop MenuCategory
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function menucategories(int $id)
    {
        $response = $this->dispatch(new ShopJobs\MenuCategoriesJob($id));
        return $response;
    }

    /**
     * Show shop menus
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function menus(int $id)
    {
        $response = $this->dispatch(new ShopJobs\MenusJob($id));
        return $response;
    }

    //模糊匹配店铺
    public function search($keyword)
    {
        $response = $this->dispatch(new ShopJobs\SearchJob($keyword));
        return $response;
    }

    public function latLng()
    {
        $params = request()->all();
        $fromPos = [$params['lat'], $params['lng']];
        $response = $this->dispatch(new ShopJobs\LatlngJob($fromPos));
        return $response;
    }
}
