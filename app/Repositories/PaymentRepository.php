<?php

namespace App\Repositories;

use App\Payment;
use App\Commerce;
use App\Sale;
use App\Client;

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
        $_payment,        
        $status
    ){
        
        $payment = new Payment;

        $payment->child_table_id = $child_table_id;
        $payment->enum_type = $enum_type;
        $payment->enum_status = $status;
        $payment->client_id = $client_id;
        $payment->commerce_id = $commerce_id;
        $payment->save();
        
        if($_payment->enum_status == "PAGADO"){                     
            
            foreach ($_payment['entries'] as $entrie){                

                $entrieObj = json_decode ($entrie);

                if($entrieObj->enum_pay_with == "CTACORRIENTE"){
                    $client = Client::findOrFail($client_id);
                    $client->currentAcount()->egresses()->create([
                        'amount' =>  $entrie->amount,       
                        'description' => ""
                    ]);                  
                }   

                //!!!!!!! que hacer con los descuentos?? que son regalos!
                $payment->paydeskEntries()->create([
                    "paydesk_id" => $entrieObj->paydesk_id,
                    "amount" => $entrieObj->amount,
                    "enum_pay_with" => $entrieObj->enum_pay_with,
                    "description" => "Ingreso por pago"
                ]); 

                
            }                        
        }
        
        return $payment;
    }



    public function updatePayments(Payment $payment){

       $oldpayment = Payment::findOrFail($payment->id);

        if($oldpayment->enum_status == "PENDIENTE" && $payment->enum_status =="PAGADO" ){

            foreach ($payment['entries'] as $entrie){  
                
                $entrieObj = json_decode ($entrie); 

                $payment->paydeskEntries()->create([
                    "paydesk_id" => $entrieObj->paydesk_id,
                    "amount" => $entrieObj->amount,
                    "enum_pay_with" => $entrieObj->enum_pay_with,
                    "description" => "Ingreso por pago"
                ]);

              
            }           
          
        }

        if($oldpayment->enum_status == "CANCELADO" &&  $payment->enum_status == "PAGADO"){

            foreach ($payment['entries'] as $entrie){  
                
                $entrieObj = json_decode ($entrie); 

                $payment->paydeskEntries()->create([
                    "paydesk_id" => $entrieObj->paydesk_id,
                    "amount" => $entrieObj->amount,
                    "enum_pay_with" => $entrieObj->enum_pay_with,
                    "description" => "Ingreso por pago"
                ]);
                
            }           

        } 

        if($oldpayment->enum_status == "PAGADO" &&   $payment->enum_status == "PENDIENTE" ){
            $payment->paydeskEntries()->delete();
        }

        if($oldpayment->enum_status == "PAGADO" && $payment->enum_status == "CANCELADO" ){
            $payment->paydeskEntries()->delete();
        }

        $oldpayment->update([
            "enum_state" => $payment->enum_status
        ]);

        
        return $return;
    }

}