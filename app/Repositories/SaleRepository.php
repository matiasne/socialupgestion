<?php

namespace App\Repositories;

use App\Commerce;
use App\Sale;

use App\Repositories\PaymentRepository;


use App\Http\Requests\SaleStoreRequest;
use App\Http\Requests\SaleUpdateRequest;

class SaleRepository{

    protected $pagare;

    public function __construct(PaymentRepository $pagare)
    {
        $this->pagare = $pagare;
    }

    
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
            "total_cost" => $request->total_cost,
            "enum_estatus" => $request->enum_estatus
        ]);

        foreach ($request['products'] as $product){
            $sale->products()->attach($product);
        }

        $sale->save();

        $this->pagare->generatePaymentSale($sale->id,$request->total_cost,$request->client_id,$commerce->id,$request->enum_estatus);

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
            "total_cost" => $request->total_cost,
            "enum_estatus" => $request->enum_estatus
        ]);
        
        $sale->products()->detach();

        foreach ($request['products'] as $product){
            $sale->products()->attach($product);
        }

        $sale->save();
        
        $this->pagare->updatePaymentSale($sale->id,$request->total_cost,$request->client_id,$commerce->id);

        return ["code" => "200", "message" =>"success", "data" => $sale];  
    }

    public function destroySale(Sale $sale){
        
        $sale->products()->detach();

        $sale->delete();

        return ["code" => "200", "meesage" => "Eliminado"];
    }

}