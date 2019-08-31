<?php

namespace App\Repositories;

use App\Http\Requests\Request;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\CommerceStoreRequest;
use App\Http\Requests\SubscriptionUpdateRequest;

class ImgRepository{

    public function imgProduct( ProductStoreRequest $request){
        $file = $request->imgproduct;
    
        $file->move('imgProducts', $file->getClientOriginalName());

        $filename = $file->getClientOriginalName();

        return 'http://localhost/socialupgestion/public/imgProducts/'.$filename;
    }

    public function imgUser(Request $request){
       
        $file = $request->imguser;
    
        $file->move('imgUsers', $file->getClientOriginalName());

        $filename = $file->getClientOriginalName();

        return 'http://localhost/socialupgestion/public/imgUsers/'.$filename;
    }

    public function imgCommerce(CommerceStoreRequest $request){
       
        $file = $request->imgcommerce;
    
        $file->move('imgCommerces', $file->getClientOriginalName());

        $filename = $file->getClientOriginalName();

        return 'http://localhost/socialupgestion/public/imgCommerces/'.$filename;
    }
}