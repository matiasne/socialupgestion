<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $product = Product::get();
        return $product;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Obtener usuario, del usuario $user->commerce->id

      /*  $request->validate([
            'name' => 'required',
            'description' => 'required',             
            'stock' => 'required',
            'price' => 'required', 
            'id_commerce' => 'required',  
        ]);   */    

        $prod = Product::create([
            "name" => $request->name,
            "description" => $request->description,
            "stock" => $request->stock,
            "price" => $request->price,
            "id_commerce" =>  "9999",  
            "id_provider" => $request->id_provider,
            "id_category" => $request->id_category
        ]);     
            
        return ["code" => "200", "message" =>"success", "data" => $prod];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
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
    public function update(Request $request, Product $product)
    {
        //$product = Product::findOrFail($request['id']);

        $product->update([
            "name" => $request->name,
            "description" => $request->description,
            "stock" => $request->stock,
            "price" => $request->price,
            "id_commerce" => "9999",// $user->commerce->id,  
            "id_provider" => $request->id_provider,
            "id_category" => $request->id_category
        ]);
        
        $product->save();

        return ["Status" => "200", "message" => "Actualizado", "data" => $product];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return ["code" => "200", "meesage" => "Eliminado"];
    }
}
