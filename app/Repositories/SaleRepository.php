<?php

namespace App\Repositories;

use App\Commerce;
use App\Sale;
use App\Payment;
use App\SalesProductDetail;

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
            "enum_status" => $request->enum_status, 
            "enum_pay_with" =>$request->enum_pay_with           
        ]);

        foreach ($request['products'] as $product){

            $productObj = json_decode ($product);          

            $sale->productsDetails()->create([
                "product_id" => $productObj->id,
                "product_amount" => $productObj->amount,
                "product_price" => $productObj->price
            ]);
           
        }

        foreach ($request['services'] as $service){

            $serviceObj = json_decode ($service);          

            $sale->servicesDetails()->create([
                "service_id" => $serviceObj->id,
                "service_amount" => $serviceObj->amount,
                "service_price" => $serviceObj->price
            ]);
           
        }

        $sale->save();

        $dataRequest = $request->all();

        $data = $sale;

        $this->rPagare->generatePayment(
            $dataRequest,
            $data,
            $commerce->id,
            "SALE",
            $request->enum_status
        );
       

        return $sale;

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
            "enum_status" => $request->enum_status,
            "enum_pay_with" =>$request->enum_pay_with 
        ]);
        
        $sale->products()->detach();

        foreach ($request['products'] as $product){
            
            $productObj = json_decode ($product);

            $sale->productsDetails()->create([
                "product_id" => $product->id,
                "product_amount" => $product->amount,
                "product_price" => $product->price
            ]);
            
        }

        foreach ($request['services'] as $service){
            
            $serviceObj = json_decode ($service);

            $sale->servicesDetails()->create([
                "service_id" => $service->id,
                "service_amount" => $service->amount,
                "service_price" => $service->price
            ]);
            
        }

        $sale->save();

        $data = $request->all();
        
        $this->rPagare->updatePayment($data,$sale->payments()->first(),$request->enum_status);


        return $sale;  
    }

    public function destroySale( Sale $sale){
        
        $payments = $sale->payments()->get();
        
        foreach($payments as $payment){          

            $entries = $payment->entries()->get();            

            foreach($entries as $entry){
                $entry->delete();
            }

            $egresses= $payment->egresses()->get();

            foreach($egresses as $egress){
                $egress->delete();
            }

            $payment->delete();
        }

        $sale->products()->detach();
        $sale->services()->detach();

        $sale->delete();
            
        return true;

       
    }

}