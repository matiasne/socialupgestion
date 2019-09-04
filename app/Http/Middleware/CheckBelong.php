<?php

namespace App\Http\Middleware;

use Closure;

class CheckBelong
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
        $commerce =  $request->route()->parameters()['commerce'];   

        $ArrayidBelongs =  $commerce->users()->pluck('id')->toArray();

        if (in_array($request->user('api')->id, $ArrayidBelongs)){
            return $next($request);
        }
        else{
            
            abort(403, 'No perteneces al comercio');
        }
    }
}
