<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\Api\V1\MenuType as MenuTypeJobs;

class MenuTypeController extends Controller
{
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
     * show menutype menucategories lists.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function menuCategories($id)
    {
        $response = $this->dispatch(new MenuTypeJobs\MenuCategoryJob($id));
        return $response;
    }
}
