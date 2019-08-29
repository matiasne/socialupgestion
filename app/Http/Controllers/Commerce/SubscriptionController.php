<?php

namespace App\Http\Controllers\Commerce;
use App\Http\Controllers\Controller;

use App\Subscription;
use App\Commerce;
use Illuminate\Http\Request;
use App\Http\Requests\SubscriptionStoreRequest;
use App\Http\Requests\SubscriptionUpdateRequest;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Commerce $commerce)
    {
        $subs = $commerce->subscription()->get();
        return $subs;
    }    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubscriptionStoreRequest $request, Commerce $commerce)
    {   
        $data = $request->validated();

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
            

        return ["code" => "200", "message" =>"success", "data" => $subs];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Commerce $commerce, Subscription $subscription)
    {
        return $subscription;
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(SubscriptionUpdateRequest $request, Commerce $commerce, Subscription $subscription)
    {
       /* $subs = Subscription::findOrFail($subscription_id);*/
        
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

        return ["code" => "200", "message" => "Actualizado", "data" => $subscription];

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commerce $commerce,Subscription $subscription)
    {
        $subscription->services()->detach();
        
        $subscription->delete();
        
        return ["code" => "200", "meesage" => "Eliminado"];
    }
}
