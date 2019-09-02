<?php

namespace App\Repositories;

use App\Subscription;
use App\Commerce;

use App\Repositories\PaymentRepository;

use App\Http\Requests\SubscriptionStoreRequest;
use App\Http\Requests\SubscriptionUpdateRequest;

class SubscriptionRepository{

    protected $pagare;

    public function __construct(PaymentRepository $pagare)
    {
        $this->pagare = $pagare;
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
            "start_date" => $request->start_date

        ]); 
        
        foreach ($request['services_ids'] as $service_id){
            $subs->services()->attach($service_id);
        }
        
        $subs->save();

        $this->pagare->generatePaymentSubscription($subs->id,$request->enum_start_payment,$request->total_cost,$request->client_id,$commerce->id);

        return ["code" => "200", "message" =>"success", "data" => $subs];

    }

    public function getone(Subscription $subscription){
        
        return $subscription;
    }

    public function updateSubscription(SubscriptionUpdateRequest $request , Commerce $commerce, Subscription $subscription){
        
        $subscription->update([
            "commerce_id" =>  $commerce->id,  
            "client_id" => $request->client_id,
            "employe_id" => $request->employe_id,
            "enum_start_payment" => $request->enum_start_payment,
            "description" => $request->description,
            "total_cost" => $request->total_cost,
            "period" => $request->period,
            "start_date" => $request->start_date
        ]);

        $subscription->services()->detach();

        foreach ($request['services_ids'] as $service_id)
            $subscription->services()->attach($service_id);

        $subscription->save();

        $this->pagare->updatePaymentSubscription($subscription->id,$request->enum_start_payment,$request->total_cost,$request->client_id,$commerce->id);

        return ["code" => "200", "message" => "Actualizado", "data" => $subscription];
    }

    public function destroySubscription(Subscription $subscription){
        
        $subscription->services()->detach();
        
        $subscription->delete();
        
        return ["code" => "200", "meesage" => "Eliminado"];
    }

}