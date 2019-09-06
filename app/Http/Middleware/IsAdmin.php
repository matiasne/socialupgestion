<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
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

        $ArrayidBelongs =  $commerce->admins()->pluck('id')->toArray();        

        if (in_array($request->user('api')->id, $ArrayidBelongs)){
            return $next($request);
        }
        else{
            
            abort(403, 'No tienes permisos de Administrador');
        }
    }
}