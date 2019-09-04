<?php

namespace App\Http\Middleware;

use App\Commerce;
use Closure;

class CheckIdBelong
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
        $commerce_id =  $request->route()->parameters()['commerce_id'];       
        
        $commerce = Commerce::where('id',$commerce_id)->first();  
       
        $ArrayidBelongs =  $commerce->users()->pluck('id')->toArray();

        if (in_array($request->user('api')->id, $ArrayidBelongs)){
            return $next($request);
        }
        else{            
            abort(403, 'No perteneces al comercio');
        }
    }
}
