<?php

namespace App\Repositories;

use App\Payment;
use App\Commerce;
use App\Sale;

use App\Http\Requests\SaleStoreRequest;
use App\Repositories\CajaRepository;


class PaymentRepository{

    protected $caja;

    public function __construct(CajaRepository $caja)
    {
        $this->caja = $caja;
    }

    public function generatePaymentSale($sale_id, $total_cost, $client_id, $commerce_id, $status){
       
        $payment = Payment::create([
            "child_table" => $sale_id,
            "enum_type" => "Venta",
            "status" =>  $status,
            "total_cost" => $total_cost,
            "client_id" => $client_id,
            "commerce_id" => $commerce_id
        ]);
        
        $payment->save();
        
        if($status == "PAGADO"){
            $this->caja->generateEntry($payment->id,$payment->total_cost,$commerce_id);
        }

        return ["code" => "200", "message" =>"success", "data" => $payment];
    }

    public function updatePaymentSale($sale_id,  $status){
        
        $payment = Payment::where('child_table',$sale_id)->where('enum_type','VENTA');

        $payment->update([
            "status" =>  $status,
        ]);

        if($status == "PAGADO"){
            $this->caja->generateEntry($payment->id,$payment->total_cost,$payment->commerce_id);
        }
    
        return ["code" => "200", "message" =>"success", "data" => $payment];
    }


    public function generatePaymentSubscription($subcription_id, $status, $total_cost, $client_id, $commerce_id){
       
        $payment = Payment::create([
            "child_table" => $subcription_id,
            "enum_type" => "SUBSCRIPCION",
            "status" => $status,
            "total_cost" => $total_cost,
            "client_id" => $client_id,
            "commerce_id" => $commerce_id
        ]);     
        
        $payment->save();

        if($status == "PAGADO"){
            $this->caja->generateEntry($payment->id,$payment->total_cost,$commerce_id);
        }

        return ["code" => "200", "message" =>"success", "data" => $payment];
    }

    public function updatePaymentSubscription($subcription_id, $status){
       
        $payment = Payment::where('child_table',$subcription_id)->where('enum_type','SUBSCRIPCION');

        $payment->update([
            "status" => $status
        ]);

        if($status == "PAGADO"){
            $this->caja->generateEntry($payment->id,$payment->total_cost,$payment->commerce_id);
        }

        return ["code" => "200", "message" =>"success", "data" => $payment];
    }

}