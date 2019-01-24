<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\Api\V1\Follow as FollowJobs;

class FollowController extends Controller
{
    public function index()
    {
        $params = request()->all();
        $response = $this->dispatch(new FollowJobs\IndexJob($params));
        return $response;
    }

    public function operate()
    {
        $params = request()->all();
        $response = $this->dispatch(new FollowJobs\OperateJob($params));
        return $response;
    }
}
