<?php

namespace App\Http\Controllers\Commerce;
use App\Http\Controllers\Controller;

use App\Sale;
use App\Commerce;
use App\Product;

use Illuminate\Http\Request;
use App\Http\Requests\SaleStoreRequest;
use App\Http\Requests\SaleUpdateRequest;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Commerce $commerce)
    {
        return $commerce->sales()->get();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleStoreRequest $request, Commerce $commerce)
    {   
       $data = $request->validated();
      
        $sale = Sale::create([
            "client_id" => $request->client_id,
            "commerce_id" =>$commerce->id,
            "employe_id" => $request->employe_id,
            "creation_date" => $request->creation_date,
            "description" => $request->description,
        ]);

        foreach ($request['products'] as $product){
            $sale->products()->attach($product);
        }

        $sale->save();

        return ["code" => "200", "message" =>"success", "data" => $sale];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Commerce $commerce,Sale $sale)
    {
        return $sale;
        //->products()->get();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(SaleUpdateRequest $request, Commerce $commerce,Sale $sale)
    {
        
        $data = $request->validated();

        $sale->update([
            "client_id" => $request->client_id,
            "commerce_id" =>$commerce->id,
            "employe_id" => $request->employe_id,
            "creation_date" => $request->creation_date,
            "description" => $request->description

        ]);
        
        $sale->products()->detach();

        foreach ($request['products'] as $product){
            $sale->products()->attach($product);
        }

        $sale->save();

        return ["code" => "200", "message" =>"success", "data" => $sale];    
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commerce $commerce,Sale $sale)
    {
        $sale->delete();

        return ["code" => "200", "meesage" => "Eliminado"];
    }
}
