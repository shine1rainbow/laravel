<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\MenuCategory as MenuCategoryRequests;
use App\Jobs\Backend\MenuCategory as MenuCategoryJobs;

class MenuCategoryController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | MenuCategory Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling restful menuCategory.
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuCategoryRequests\StoreRequest $request)
    {
        $params = $request->all();
        $response = $this->dispatch(new MenuCategoryJobs\StoreJob($params));
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(int $id, MenuCategoryRequests\UpdateRequest $request)
    {
        $params = $request->all();
        $params['id'] = $id;
        $response = $this->dispatch(new MenuCategoryJobs\UpdateJob($params));
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $response = $this->dispatch(new MenuCategoryJobs\DestroyJob($id));
        return $response;
    }
}
