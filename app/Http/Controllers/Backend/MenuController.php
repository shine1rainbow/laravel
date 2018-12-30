<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Menu as MenuRequests;
use App\Jobs\Backend\Menu as MenuJobs;

class MenuController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Menu Controller
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
        $response = $this->dispatch(new MenuJobs\IndexJob());
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequests\StoreRequest $request)
    {
        $params = $request->all();
        $response = $this->dispatch(new MenuJobs\StoreJob($params));
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
        $response = $this->dispatch(new MenuJobs\ShowJob($id));
        return $response;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(int $id, MenuRequests\UpdateRequest $request)
    {
        $params = request()->only(
            'id','menu_categroy_id', 'menu_name', 'menu_no', 'avater',
            'detail_img', 'price', 'number', 'status','spicy',
            'order', 'is_recommend', 'is_hot', 'introduction'
        );
        $params['id'] = $id;
        $response = $this->dispatch(new MenuJobs\UpdateJob($params));
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
        $response = $this->dispatch(new MenuJobs\DestroyJob($id));
        return $response;
    }

    /**
     * show menu menuoptions lists.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function menuOptions($id)
    {
        $response = $this->dispatch(new MenuJobs\MenuOptionJob($id));
        return $response;
    }

    /**
     * show menu menuoptions lists.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function menuAdditions($id)
    {
        $response = $this->dispatch(new MenuJobs\MenuAdditionJob($id));
        return $response;
    }
}
