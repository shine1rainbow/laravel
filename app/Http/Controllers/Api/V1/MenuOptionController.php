<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\Api\V1\MenuOption as MenuOptionJobs;

class MenuOptionController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $response = $this->dispatch(new MenuOptionJobs\ShowJob($id));
        return $response;
    }
}
