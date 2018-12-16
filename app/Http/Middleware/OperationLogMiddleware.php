<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Jobs\LowQueue\OperationLogJob;

class OperationLogMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        $params = [
            'user_id' => empty($user->id) ? 0 : $user->id,
            'user_name' => empty($user->name) ? 0 : $user->name,
            'client_address' => $request->ip(),
            'user_agent' => json_encode($request->header()['user-agent']),
            'path' => $request->url(),
            'method' => $request->method(),
            'params' => json_encode($request->query->all()),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];

        OperationLogJob::dispatch($params);
        return $next($request);
    }
}
