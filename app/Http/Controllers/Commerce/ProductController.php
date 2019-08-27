<?php

namespace App\Http\Controllers\Commerce;
use App\Http\Controllers\Controller;

use App\Product;
use App\Commerce;
use Illuminate\Http\Request;
use App\Http\Requests\ProductStoreRequest;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Commerce $commerce)
    {   
        $products = $commerce->products()->get();
        return $products;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request, Commerce $commerce)
    {       

        $prod = Product::create([
            "name" => $request->name,
            "description" => $request->description,
            "stock" => $request->stock,
            "price" => $request->price,
            "commerce_id" =>  $commerce->id,  
            "provider_id" => $request->provider_id,
            "category_id" => $request->category_id
        ]);     

        return ["code" => "200", "message" =>"success", "data" => $prod];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Commerce $commerce, Product $product)
    {
        return $product;
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $commerce_id, $product_id)
    {

        $product = Product::findOrFail($product_id);
       
        
        $product->update([
            "name" => $request->name,
            "description" => $request->description,
            "stock" => $request->stock,
            "price" => $request->price,
            "commerce_id" => $commerce_id,// $user->commerce->id,  
            "provider_id" => $request->provider_id,
            "category_id" => $request->category_id
        ]);
        
        $product->save();

        return ["code" => "200", "message" => "Actualizado", "data" => $product];
    }

    public function destroy($commerce_id,$product_id)
    {
        $product = Product::findOrFail($product_id);
        $product->delete();
        return ["code" => "200", "meesage" => "Eliminado"];
    }

   
}
