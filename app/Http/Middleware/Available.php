<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Available
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        switch($role){
            case 'available':
                if($request->user()->status_id !== 1){
                    if($request->ajax())
                        return response('Access Denied')->setStatusCode(403);
                    abort(403);
                }
                break;
            default:
                return response('Access Denied')->setStatusCode(403);
                break;
        }

        return $next($request);
    }
}
