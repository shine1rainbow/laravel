<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\MenuType as MenuTypeRequests;
use App\Jobs\Backend\MenuType as MenuTypeJobs;

class MenutypeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | MenuType Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling restful menuType.
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
        $response = $this->dispatch(new MenuTypeJobs\IndexJob());
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuTypeRequests\StoreRequest $request)
    {
        $params = $request->all();
        $response = $this->dispatch(new MenuTypeJobs\StoreJob($params));
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
        $response = $this->dispatch(new MenuTypeJobs\ShowJob($id));
        return $response;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(int $id)
    {
        $params = request()->all();
        $params['id'] = $id;
        $response = $this->dispatch(new MenuTypeJobs\UpdateJob($params));
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
        $response = $this->dispatch(new MenuTypeJobs\DestroyJob($id));
        return $response;
    }

    /**
     * show user menutype lists.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function user()
    {
        $user = request()->user();
        $response = $this->dispatch(new MenuTypeJobs\UserJob($user));
        return $response;
    }
}
