<?php

namespace App\Http\Middleware;

use Closure;

class Access
{
    public function handle($request, Closure $next, $access)
    {

        if(!$request->user()->inRole($access)){
            if($request->ajax())
                return response('Access Denied')->setStatusCode(403);
            abort(404);
        }
        return $next($request);
    }
}
