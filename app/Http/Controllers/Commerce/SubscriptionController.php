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

    protected $Subsrepo;

    public function __construct(SubscriptionRepository $sub)
    {
        $this->Subsrepo = $sub;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Commerce $commerce)
    {
        return $this->Subsrepo->getall($commerce);
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

        return $this->Subsrepo->storeSubscription($request,$commerce);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Commerce $commerce, Subscription $subscription)
    {
        return $this->Subsrepo->getone($subscription);
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

        return $this->Subsrepo->updateSubscription($request,$commerce,$subscription);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commerce $commerce,Subscription $subscription)
    {
        return $this->Subsrepo->destroySubscription($subscription);
    }
}
