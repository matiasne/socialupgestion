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


        if($enum_type == "CTACORRIENTE"){

            //Acá genera un agreso de la cuenta corriente del cliente

          
        }
        
        
        if($payment->enum_status == "PAGADO"){   
            
            foreach ($payment['entries'] as $entrie){                

                $entrieObj = json_decode ($entrie);

                $this->rPaydesk->generatePaydeskEntry(
                    $entrieObj->paydesk_id,
                    $entrieObj->id,
                    $entrieObj->amount,
                    $entrieObj->enum_pay_with,
                    "Ingreso por pago"
                );    
            }

                        
        }
        return $payment;
    }



    public function updatePayments(Payment $payment){

       $oldpayment = Payment::findOrFail($payment->id);

        if($oldpayment->enum_status == "PENDIENTE" && $payment->enum_status =="PAGADO" ){

            foreach ($payment['entries'] as $entrie){  
                
                $entrieObj = json_decode ($entrie); 

                $this->rPaydesk->generatePaydeskEntry(
                    $entrieObj->paydesk_id,
                    $entrieObj->id,
                    $entrieObj->amount,
                    $entrieObj->enum_pay_with,
                    "Ingreso por pago"
                );    
            }           
          
        }

        if($oldpayment->enum_status == "CANCELADO" &&  $payment->enum_status == "PAGADO"){

            foreach ($payment['entries'] as $entrie){  
                
                $entrieObj = json_decode ($entrie); 

                $this->rPaydesk->generatePaydeskEntry(
                    $entrieObj->paydesk_id,
                    $entrieObj->id,
                    $entrieObj->amount,
                    $entrieObj->enum_pay_with,
                    "Ingreso por pago"
                );    
            }           

        } 

        if($oldpayment->enum_status == "PAGADO" &&   $payment->enum_status == "PENDIENTE" ){

            $this->rPaydesk->generatePaydeskEgress(
                $payment->paydesk_id,
                $payment->id,
                $payment->mount,
                "Salida de PAGADO a PENDIENTE"
            );
            $payment->enum_status =  $status;
            $payment->save();            
        }

        if($oldpayment->enum_status == "PAGADO" && $payment->enum_status == "CANCELADO" ){
            
            $this->rPaydesk->generatePaydeskEgress(
                $payment->paydesk_id,
                $payment->id,
                $payment->mount,
                "Salida de PAGADO a PENDIENTE"
            );
            $payment->enum_status =  $status;
            $payment->save();

        }

        $oldpayment->update([
            "enum_state" => $payment->enum_status
        ]);

        
        return $return;
    }

}