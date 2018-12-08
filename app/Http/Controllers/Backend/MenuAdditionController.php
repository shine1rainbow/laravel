<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\MenuAddition as MenuAdditionRequests;
use App\Jobs\Backend\MenuAddition as MenuAdditionJobs;

class MenutypeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | MenuAddition Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling restful menuAddition.
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
        $response = $this->dispatch(new MenuAdditionJobs\IndexJob());
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuAdditionRequests\StoreRequest $request)
    {
        $params = $request->all();
        $response = $this->dispatch(new MenuAdditionJobs\StoreJob($params));
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
        $response = $this->dispatch(new MenuAdditionJobs\ShowJob($id));
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
        $response = $this->dispatch(new MenuAdditionJobs\UpdateJob($params));
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
        $response = $this->dispatch(new MenuAdditionJobs\DestroyJob($id));
        return $response;
    }
}
