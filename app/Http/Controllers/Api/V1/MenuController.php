<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\Api\V1\Menu as MenuJobs;

class MenuController extends Controller
{
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
