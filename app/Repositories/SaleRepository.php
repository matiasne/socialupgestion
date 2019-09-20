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

        //Si la venta está pagada entonces genera los pagos si no genera un pago pendiente
        if($request->enum_status == "PAGADO"){

            foreach ($request['payments'] as $payment){                

                $this->rPagare->generatePayment(
                    $sale->client_id,
                    $commerce->id,
                    "SALE",
                    $sale->id,
                    $payment,
                    "PAGADO"
                );
            }
        }
        else{

            $this->rPagare->generatePayment(
                $sale->client_id,
                $commerce->id,
                "SALE",
                $sale->id,
                $payment,
                "PENDIENTE"
            );

        }
        

        $sale->save();

        
       

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
            "enum_status" => $request->enum_status
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

        $sale->services()->detach();

        foreach ($request['services'] as $service){
            
            $serviceObj = json_decode ($service);
            $sale->servicesDetails()->create([
                "service_id" => $service->id,
                "service_amount" => $service->amount,
                "service_price" => $service->price
            ]);            
        }

        $sale->payments->paydeskEntries()->delete();
        $sale->payments->paydeskEgresses()->delete();
        $sale->payments()->delete();

        if($request->enum_status == "PAGADO"){

            foreach ($request['payments'] as $payment){      
           
                $this->rPagare->generatePayment(
                    $sale->client_id,
                    $commerce->id,
                    "SALE",
                    $sale->id,
                    $payment,
                    "PAGADO"
                );

               
            }
        }
        else{
            
            $this->rPagare->generatePayment(
                $sale->client_id,
                $commerce->id,
                "SALE",
                $sale->id,
                $payment,
                "PENDIENTE"
            );
        }

        $sale->save();       
        return $sale;  
    }

    public function destroySale( Sale $sale){
        
        $payments = $sale->payments()->get();
        
        foreach($payments as $payment){          

            $paydeskEntries = $payment->paydeskEntries()->get();            

            foreach($paydeskEntries as $paydeskEntry){
                $paydeskEntry->delete();
            }

            $paydeskEgresses= $payment->paydeskEgresses()->get();

            foreach($paydeskEgresses as $paydeskEgress){
                $paydeskEgress->delete();
            }

            $payment->delete();
        }

        $sale->products()->detach();
        $sale->services()->detach();

        $sale->delete();
            
        return true;

       
    }

}