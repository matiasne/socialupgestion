<?php

namespace App\Repositories;

use App\Commerce;
use App\Sale;
use App\Payment;

use App\Repositories\PaymentRepository;


use App\Http\Requests\SaleStoreRequest;
use App\Http\Requests\SaleUpdateRequest;

class SaleRepository{

    protected $rPagare;

    public function __construct(PaymentRepository $rpagare)
    {
        $this->rPagare = $rpagare;
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
            "enum_status_sale" => $request->enum_status,            
        ]);

        foreach ($request['products'] as $product){
            $sale->products()->attach($product);
        }

        $sale->save();

        $dataRequest = $request->all();

        $data = $sale;

        $this->rPagare->generatePayment($dataRequest,$data,$commerce->id,"SALE",$request->enum_status);
       

        return ["code" => "200", "message" =>"success", "data" => $sale];

    }

    public function getone(Sale $sale){
        
        return $sale;
    }

    public function updateSale(SaleUpdateRequest $request , Commerce $commerce, Sale $sale){
        
        $sale->update([
            "client_id" => $request->client_id,
            "employe_id" => $request->employe_id,
            "description" => $request->description,
            "total_cost" => $request->total_cost,
            "enum_status" => $request->enum_status
        ]);
        
        $sale->products()->detach();

        foreach ($request['products'] as $product){
            $sale->products()->attach($product);
        }

        $sale->save();

        $payment = Payment::where('child_table',$sale->id)->where('enum_type','SALE')->first();  
        
        $data = $request->all();
        
        $this->rPagare->updatePayment($data,$payment,$request->enum_status);


        return ["code" => "200", "message" =>"success", "data" => $sale];  
    }

    public function destroySale( Sale $sale){
        
        $payments = $sale->payments()->get();
        
        foreach($payments as $payment){          

            $entrys = $payment->entrys()->get();
            

            foreach($entrys as $entry){
                $entry->delete();
            }

            $egress= $payment->egress()->get();

            foreach($egress as $egres){
                $egres->delete();
            }

            $payment->delete();
        }

        $sale->delete();
            
        return ["code" => "200", "meesage" => "Eliminado"];

       
    }

}