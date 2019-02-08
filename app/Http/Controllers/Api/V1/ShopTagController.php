<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\Api\V1\ShopTag as ShopTagJobs;

class ShopTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = $this->dispatch(new ShopTagJobs\IndexJob());
        return $response;
    }

    public function shops($id)
    {
        $response = $this->dispatch(new ShopTagJobs\ShopJob($id));
        return $response;
    }
}
