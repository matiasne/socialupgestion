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
        $prod = Product::get();
        return $prod;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $prod = Product::create($request);
/*
        $prod->name = $request->name;
        $prod->description = $request->description;
        $prod->cantidad = $request->cantidad;

        $prod->save();*/

        return ["Status0" => "200", "Producto" => $prod];
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
        $producto = Product::findOrFail($request['id']);

        $producto->update([
            "name" => $request->name,
            "description" => $request->description,
            "cantidad" => $request->cantidad,
        ]);
        
        $producto->save();

        return ["Status" => "200", "Producto modificado" => $producto];
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
        return ["Status" => "200"];
    }
}
