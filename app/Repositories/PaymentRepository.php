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
        $client_id,
        $commerce_id,
        $enum_type,
        $child_table_id,
        $payment,        
        $status
    ){
        
        $payment = Payment::create([
            "child_table_id" => $child_table_id,
            "enum_type" => $enum_type,
            "enum_status" => $status,
            "amount" => $payment->amount,
            "client_id" => $client_id,
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



    public function updatePayments($data, Payment $payment){

    
        $return  = $payment;

        if($payment->enum_status == "PENDIENTE" && $data->enum_status =="PAGADO" ){

            foreach ($data['payments'] as $payment){
            
                $paymentObj = json_decode ($payment);    

                

                $this->generatePayment(
                    $data->client_id,
                    $data->commerce_id,
                    $data->enum_type,
                    $data->id,
                    $paymentObj,
                    $data->enum_status
                );  
            }

            $payment->delete();

          
        }

        if($payment->enum_status == "CANCELADO" &&  $data->enum_status == "PAGADO"){

            foreach ($data['payments'] as $payment){
            
                $paymentObj = json_decode ($payment);    

                $this->generatePayment(
                    $data->client_id,
                    $data->commerce_id,
                    $data->enum_type,
                    $data->id,
                    $paymentObj,
                    $data->enum_status
                );  
            }

            $payment->delete();

        } 

        if($payment->enum_status == "PAGADO" &&   $data->enum_status == "PENDIENTE" ){

            $this->rPaydesk->generatePaydeskEgress(
                $payment->paydesk_id,
                $payment->id,
                $payment->mount,
                "Salida de PAGADO a PENDIENTE"
            );
            $payment->enum_status =  $status;
            $payment->save();            
        }

        if($payment->enum_status == "PAGADO" && $data->enum_status == "CANCELADO" ){
            
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