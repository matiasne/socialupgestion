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
        $client = new Client;
        $client->name = $request->name;
        $client->address = $request->address;
        $client->phone_number = $request->phone_number;
        $client->email = $request->email;
        $client->positive_credit = $request->positive_credit;
        $client->commerce_id = $commerce->id;
             
        $client->save();

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

        
        $client->name = $request->name;
        $client->address = $request->address;
        $client->phone_number = $request->phone_number;
        $client->positive_credit = $request->positive_credit;
        $client->email = $request->email;
        
        $client->save();

        return ["Status" => "200", "message" => "Actualizado", "data" => $client];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy( Commerce $commerce ,Client $client)
    {
       
        $client->delete();
        return ["code" => "200", "meesage" => "Eliminado"];
    }
}
