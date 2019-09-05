<?php

namespace App\Http\Controllers\Commerce;
use App\Http\Controllers\Controller;

use App\Commerce;
use App\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function __construct()    {
        
        $this->middleware('isAdmin', ['only' => ['store','update','destroy']]); 
    }

   
    public function index(Commerce $commerce)
    {     
        $client = $commerce->clients()->get();
        return $client;
    } 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,  Commerce $commerce)
    {
        $client = Client::create([
            "name" => $request->name,
            "address" => $request->address,
            "phone_nunmber" => $request->phone_nunmber,
            "email" => $request->email,
            'positive_credit'=>$request->positive_credit,
            "commerce_id" => $commerce->id
        ]);     

        return ["code" => "200", "message" =>"success", "data" => $client];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Commerce $commerce,Client $client)
    {
        return $client;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $commerce_id, $client_id)
    {

        $client = Client::findOrFail($client_id);

        $client->update([
            "name" => $request->name,
            "address" => $request->address,
            "phone_nunmber" => $request->phone_nunmber,
            'positive_credit'=>$request->positive_credit,
            "email" => $request->email
        ]);
        
        $client->save();

        return ["Status" => "200", "message" => "Actualizado", "data" => $client];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy( $commerce_id, $client_id)
    {
        $client = Client::findOrFail($client_id);
        $client->delete();
        return ["code" => "200", "meesage" => "Eliminado"];
    }
}
