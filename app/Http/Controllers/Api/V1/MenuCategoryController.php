<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\Api\V1\MenuCategory as MenuCategoryJobs;

class MenuCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = $this->dispatch(new MenuCategoryJobs\IndexJob());
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
        $response = $this->dispatch(new MenuCategoryJobs\ShowJob($id));
        return $response;
    }

    /**
     * show menucategory menus lists.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function menus($id)
    {
        $response = $this->dispatch(new MenuCategoryJobs\MenuJob($id));
        return $response;
    }
}
