<?php

namespace App\Repositories;

use App\Subscription;
use App\Commerce;
use App\Payment;

use App\Repositories\PaymentRepository;

use App\Http\Requests\SubscriptionStoreRequest;
use App\Http\Requests\SubscriptionUpdateRequest;

class SubscriptionRepository{

    protected $rPagare;

    public function __construct(PaymentRepository $rPagare)
    {
        $this->rPagare = $rPagare;
    }


    public function getall(Commerce $commerce){
        
        return $commerce->subscription()->get();
    }

    public function storeSubscription(SubscriptionStoreRequest $request , Commerce $commerce){
       
        $subs = Subscription::create([
            
            "commerce_id" =>  $commerce->id,  
            "client_id" => $request->client_id,
            "employe_id" => $request->employe_id,
            "enum_start_payment" => $request->enum_start_payment,
            "description" => $request->description,
            "total_cost" => $request->total_cost,
            "period" => $request->period,
            "start_date" => $request->start_date,
            "enum_status" => $request->enum_status,
            "enum_pay_with" =>$request->enum_pay_with 

        ]); 
        
        foreach ($request['services_ids'] as $service_id){
            $subs->services()->attach($service_id);
        }
        
        $subs->save();

        $datarequest= $request->all();

        if($request->enum_start_payment == "ANTICIPADO"){
            
            $this->rPagare->generatePayment(
                $datarequest, 
                $subs, 
                $commerce->id,
                "SUBSCRIPTION",
                "PAGADO"
            );
        }      
        
        return $subs;

    }

    public function getone(Subscription $subscription){
        
        return $subscription;
    }

    public function updateSubscription(SubscriptionUpdateRequest $request , Commerce $commerce, Subscription $subscription){
        
        $subscription->update([
            "description" => $request->description,
            "total_cost" => $request->total_cost,
            "period" => $request->period,
            "enum_status" => $request->enum_status,
            "enum_pay_with" =>$request->enum_pay_with 
        ]);

        $subscription->services()->detach();

        foreach ($request['services_ids'] as $service_id)
            $subscription->services()->attach($service_id);

        $subscription->save();
        
        return $subscription;
    }

    public function destroySubscription(Subscription $subscription){
        
        $payments = $subscription->payments()->get();
        
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

        $subscription->services()->detach();
        
        $subscription->delete();
            
        return true;
    }

}