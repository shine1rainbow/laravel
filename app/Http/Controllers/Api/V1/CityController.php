<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\Api\V1\City as CityJobs;

class CityController extends Controller
{
    public function index()
    {
        $params = request()->all();
        $response = $this->dispatch(new CityJobs\IndexJob($params));
        return $response;
    }
}
