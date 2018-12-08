<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\Backend\Picture as PictureJobs;

class PictureController extends Controller
{
    /**
     * return the file server path.
     *
     * @return string path
     */
    public function getUploadPath()
    {
        $filePath = request()->file->store('shops', 'public');
        $fileFullPath = url('storage') . '/' . $filePath;
        return $fileFullPath;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = $this->dispatch(new PictureJobs\IndexJob());
        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $filePath = request()->file->store('images', 'public');
        $fileFullPath = url('storage') . '/' . $filePath;
        $params['url'] = request()->input('url');
        $params['tag_id'] = request()->input('tag_id');
        $params['order'] = is_null(request()->input('order')) ?? 1;
        $params['desc'] = is_null(request()->input('desc')) ?? '';
        $response = $this->dispatch(new PictureJobs\StoreJob($params));
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = $this->dispatch(new PictureJobs\ShowJob($id));
        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $filePath = request()->file->store('images', 'local');
        $fileFullPath = storage_path('app') . '/' . $filePath;
        $params['id'] = $id;
        $params['url'] = request()->input('url');
        $params['tag_id'] = request()->input('tag_id');
        $params['order'] = is_null(request()->input('order')) ?? 1;
        $params['desc'] = is_null(request()->input('desc')) ?? '';
        $response = $this->dispatch(new PictureJobs\UpdateJob($params));
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = $this->dispatch(new PictureJobs\DestroyJob($id));
        return $response;
    }
}
