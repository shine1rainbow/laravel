<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Shop as ShopRequests;
use App\Jobs\Backend\Shop as ShopJobs;

class ShopController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Shop Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling restful shop.
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('role:developer|admin');
    }

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
     * upload image.
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadImg()
    {
        $type = request()->input('type');
        $id = request()->input('id');
        $filePath = request()->file->store('shops', 'public');
        $fileFullPath = url('storage') . '/' . $filePath;
        $response = $this->dispatch(new ShopJobs\UploadImageJob($id, $type, $fileFullPath));
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShopRequests\StoreRequest $request)
    {
        $params = $request->all();
        $params['user_id'] = request()->user()->id ?? 1;
        $response = $this->dispatch(new ShopJobs\StoreJob($params));
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(int $id, ShopRequests\UpdateRequest $request)
    {
        $params = $request->all();
        $params['id'] = $id;
        $response = $this->dispatch(new ShopJobs\UpdateJob($params));
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
        $response = $this->dispatch(new ShopJobs\DestroyJob($id));
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

    /**
     * Show shop staffs
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function staffs(int $id)
    {
        $response = $this->dispatch(new ShopJobs\StaffsJob($id));
        return $response;
    }

    /**
     * Display shops of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function user()
    {
        $user = request()->user();
        $response = $this->dispatch(new ShopJobs\UserJob($user));
        return $response;
    }
}
