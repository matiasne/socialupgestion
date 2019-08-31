<?php

namespace App\Repositories;

use App\Commerce;
use App\Sale;

use App\Http\Requests\SaleStoreRequest;
use App\Http\Requests\SaleUpdateRequest;

class SaleRepository{

    public function getall(Commerce $commerce){
        
        return $commerce->sales()->get();
    }

    public function storeSale(SaleStoreRequest $request , Commerce $commerce){
        
        $sale = Sale::create([
            "client_id" => $request->client_id,
            "commerce_id" =>$commerce->id,
            "employe_id" => $request->employe_id,
            "creation_date" => $request->creation_date,
            "description" => $request->description,
            "total_cost" => $request->total_cost
        ]);

        foreach ($request['products'] as $product){
            $sale->products()->attach($product);
        }

        $sale->save();

        return ["code" => "200", "message" =>"success", "data" => $sale];

    }

    public function getone(Sale $sale){
        
        return $sale;
    }

    public function updateSale(SaleUpdateRequest $request , Commerce $commerce, Sale $sale){
        
        $sale->update([
            "client_id" => $request->client_id,
            "commerce_id" =>$commerce->id,
            "employe_id" => $request->employe_id,
            "creation_date" => $request->creation_date,
            "description" => $request->description,
            "total_cost" => $request->total_cost

        ]);
        
        $sale->products()->detach();

        foreach ($request['products'] as $product){
            $sale->products()->attach($product);
        }

        $sale->save();

        return ["code" => "200", "message" =>"success", "data" => $sale];  
    }

    public function destroySale(Sale $sale){
        
        $sale->products()->detach();

        $sale->delete();

        return ["code" => "200", "meesage" => "Eliminado"];
    }

}