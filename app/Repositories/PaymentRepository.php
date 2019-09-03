<?php

namespace App\Repositories;

use App\Payment;
use App\Commerce;
use App\Sale;

use App\Http\Requests\SaleStoreRequest;
use App\Repositories\CajaRepository;

use Illuminate\Http\Request;


class PaymentRepository{

    protected $caja;

    public function __construct(CajaRepository $caja)
    {
        $this->caja = $caja;
    }

    public function generatePayment($request, $data,$commerce_id,$enum_type){
        

        if($enum_type == "SALE"){
            $status = $request['enum_status'];
        }else{
            $status = "PAGADO";
        }
        $payment = Payment::create([
            "child_table" => $data->id,
            "enum_type" => $enum_type,
            "enum_status" => $status,
            "total_cost" => $data->total_cost,
            "client_id" => $data->client_id,
            "commerce_id" => $commerce_id,
        ]);
        
        $payment->save();
        
        if($payment->enum_status == "PAGADO"){
            $this->caja->generateEntry($payment->id,$payment->total_cost,$commerce_id,$request['description'],$request['caja']);
        }

        return ["code" => "200", "message" =>"success", "data" => $payment];
    }



    public function updatePayment($data, Payment $payment){

    
        if($data['enum_status'] =="PAGADO" && $payment->enum_status == "PENDIENTE"){

            $this->caja->generateEntry($payment->id,$payment->total_cost,$payment->commerce_id,$data['detalle'],$data['caja']);
        }

        if( $data['enum_status'] == "PAGADO" && $payment->enum_status == "CANCELADO"){
            
            $this->caja->generateEntry($payment->id,$payment->total_cost,$payment->commerce_id,$data['detalle'],$data['caja']);
        } 

        if($data['enum_status'] == "PENDIENTE" && $payment->enum_status == "PAGADO"){

            $this->caja->generateEgress($payment->id,$payment->total_cost,$payment->commerce_id,$data['detalle'],$data['caja']);
        }

        if($data['enum_status'] == "CANCELADO" && $payment->enum_status == "PAGADO"){
            
            $this->caja->generateEgress($payment->id,$payment->total_cost,$payment->commerce_id,$data['detalle'],$data['caja']);
        }

        $payment->enum_status =  $data['enum_status'];
        $payment->save();

        return ["code" => "200", "message" =>"success", "data" => $payment];
    }

}