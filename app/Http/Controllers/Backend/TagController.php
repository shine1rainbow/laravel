<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Tag as TagRequests;
use App\Jobs\Backend\Tag as TagJobs;

class TagController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Tag Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling restful menu.
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
        $response = $this->dispatch(new TagJobs\IndexJob());
        return $response;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user(Request $request)
    {
        $user = $request->user();
        $response = $this->dispatch(new TagJobs\UserListJob($user));
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequests\StoreRequest $request)
    {
        $user = $request->user();
        $params = $request->all();
        $params['user_id'] = $user->id;
        $response = $this->dispatch(new TagJobs\StoreJob($params));
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
        $response = $this->dispatch(new TagJobs\ShowJob($id));
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
        $response = $this->dispatch(new TagJobs\UpdateJob($params));
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
        $response = $this->dispatch(new TagJobs\DestroyJob($id));
        return $response;
    }
}
