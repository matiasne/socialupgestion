<?php

namespace App\Repositories;

use App\Http\Requests\Request;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\CommerceStoreRequest;
use App\Http\Requests\SubscriptionUpdateRequest;

class ImgRepository{

    public function imgProduct( ProductStoreRequest $request){
        
       /* $file = $request->img;
    
        $file->move('img', $file->getClientOriginalName());

        $filename = $file->getClientOriginalName();

        return 'http://localhost/socialupgestion/public/imgProducts/'.$filename;*/

        return "prueba";
    }

    public function imgUser(Request $request){
       
        /*$file = $request->img;
    
        $file->move('img', $file->getClientOriginalName());

        $filename = $file->getClientOriginalName();

        return 'http://localhost/socialupgestion/public/imgUsers/'.$filename;*/

        return "prueba";

    }

    public function imgCommerce(CommerceStoreRequest $request){
       
       /* $file = $request->img;
    
        $file->move('img', $file->getClientOriginalName());

        $filename = $file->getClientOriginalName();

        return 'http://localhost/socialupgestion/public/imgCommerces/'.$filename;*/
        return "prueba";
    }
}