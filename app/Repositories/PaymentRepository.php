<?php

namespace App\Repositories;

use App\Payment;
use App\Commerce;
use App\Sale;

use App\Http\Requests\SaleStoreRequest;
use App\Repositories\PaydeskRepository;

use Illuminate\Http\Request;


class PaymentRepository{

    protected $rPaydesk;

    public function __construct(PaydeskRepository $rPaydesk)
    {
        $this->rPaydesk = $rPaydesk;
    }

    public function generatePayment(
        $payment, 
        $data, //sale
        $commerce_id,
        $enum_type,
        $status
    ){
        
        $payment = Payment::create([
            "child_table_id" => $data->id,
            "enum_type" => $enum_type,
            "enum_status" => $status,
            "amount" => $payment->amount,
            "client_id" => $data->client_id,
            "commerce_id" => $commerce_id,
        ]);
        
        
        if($payment->enum_status == "PAGADO"){      


            $this->rPaydesk->generatePaydeskEntry(
                $payment->paydesk_id,
                $payment->id,
                $payment->amount,
                $payment->enum_pay_with,
                "Ingreso por pago"
            );                
               
        }
        return $payment;
    }



    public function updatePayment($data, Payment $payment, $newStatus){

    
        $return  = $payment;

        if($payment->enum_status == "PENDIENTE" && $newStatus =="PAGADO" ){

            foreach ($data['payments'] as $payment){
            
                $paymentObj = json_decode ($payment);    

                $this->generatePayment(
                    $paymentObj,
                    $data,
                    $paymentObj->commerce_id,
                    $data->enum_type,
                    $newStatus
                );  
            }

            $payment->delete();

          
        }

        if($payment->enum_status == "CANCELADO" &&  $newStatus == "PAGADO"){

            foreach ($data['payments'] as $payment){
            
                $paymentObj = json_decode ($payment);    

                $this->generatePayment(
                    $paymentObj,
                    $data,
                    $paymentObj->commerce_id,
                    $data->enum_type,
                    $newStatus
                );  
            }

            $payment->delete();

        } 

        if($payment->enum_status == "PAGADO" &&   $newStatus == "PENDIENTE" ){

            $this->rPaydesk->generatePaydeskEgress(
                $payment->paydesk_id,
                $payment->id,
                $payment->mount,
                "Salida de PAGADO a PENDIENTE"
            );
            $payment->enum_status =  $status;
            $payment->save();

            
        }

        if($payment->enum_status == "PAGADO" && $newStatus == "CANCELADO" ){
            
            $this->rPaydesk->generatePaydeskEgress(
                $payment->paydesk_id,
                $payment->id,
                $payment->mount,
                "Salida de PAGADO a PENDIENTE"
            );
            $payment->enum_status =  $status;
            $payment->save();

        }

        
        return $return;
    }

}