<?php

namespace App\Http\Middleware;

use Closure;

class Access
{
    public function handle($request, Closure $next, $role)
    {
        foreach ($request->user()->roles as $role) {
            switch($role->slug){
                case 'manager':
                    if(!\Auth::user()){
                        if($request->ajax())
                            return response('Access Denied')->setStatusCode(403);
                        abort(404);
                    }else
                        if($role->slug !== 'manager'){
                            if($request->ajax())
                                return response('Access Denied')->setStatusCode(403);
                            abort(404);
                        }
                    break;
                default:
                    return response('Access Denied')->setStatusCode(403);
                    break;
            }
        }

        return $next($request);
    }
}
