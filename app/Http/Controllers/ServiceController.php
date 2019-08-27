<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;
use App\Http\Requests\ServiceStoreRequest;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $service = Service::get();
        return $service;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceStoreRequest $request)
    {
        //
        $serv = Service::create([
            "name" => $request->name,
            "description" => $request->description,
            "price" => $request->price,
            "id_commerce" =>  "9999",  
            "id_category" => $request->id_category
        ]);     

        return ["code" => "200", "message" =>"success", "data" => $serv];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        //
        $service->update([
            "name" => $request->name,
            "description" => $request->description,
            "price" => $request->price,
            "id_commerce" => "9999",// $user->commerce->id,  
            "id_category" => $request->id_category
        ]);
        
        $service->save();

        return ["code" => "200", "message" => "Actualizado", "data" => $service];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
        $service->delete();
        return ["code" => "200", "meesage" => "Eliminado"];
    }
}
