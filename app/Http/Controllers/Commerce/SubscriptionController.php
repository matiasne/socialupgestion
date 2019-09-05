<?php

namespace App\Http\Controllers\Commerce;
use App\Http\Controllers\Controller;
use App\Repositories\SubscriptionRepository;

use App\Subscription;
use App\Commerce;
use Illuminate\Http\Request;
use App\Http\Requests\SubscriptionStoreRequest;
use App\Http\Requests\SubscriptionUpdateRequest;

class SubscriptionController extends Controller
{   

    protected $rSubscription;

    public function __construct(SubscriptionRepository $rsub)
    {
        $this->rSubscription = $rsub;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Commerce $commerce)
    {
        return $this->rSubscription->getall($commerce);
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

        $result = $this->rSubscription->storeSubscription($request,$commerce);

        return ["code" => "200", "message" =>"success", "data" => $result];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Commerce $commerce, Subscription $subscription)
    {
        return $this->rSubscription->getone($subscription);
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
        $data = $request->validated();

        $result = $this->rSubscription->updateSubscription($request,$commerce,$subscription);

        return ["code" => "200", "message" =>"success", "data" => $result];

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commerce $commerce,Subscription $subscription)
    {
        $result =  $this->rSubscription->destroySubscription($subscription);

        return ["code" => "200", "message" =>"success", "data" => $result];
    }
}
