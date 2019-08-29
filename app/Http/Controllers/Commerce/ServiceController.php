<?php
namespace App\Http\Controllers\Commerce;
use App\Http\Controllers\Controller;

use App\Commerce;
use App\Service;
use App\Commerce;

use Illuminate\Http\Request;
use App\Http\Requests\ServiceStoreRequest;
use App\Http\Requests\ServiceUpdateRequest;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Commerce $commerce)
    {
        
        $services = $commerce->services()->get();
        return $services;
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceStoreRequest $request, Commerce $commerce)
    {
        
        $data = $request->validated();

        $serv = Service::create([
            "name" => $request->name,
            "description" => $request->description,
            "price" => $request->price,
            "commerce_id" =>  $commerce->id,  
            "category_id" => $request->category_id
        ]);     

        return ["code" => "200", "message" =>"success", "data" => $serv];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Commerce $commerce, Service $service)
    {
        //
        return $service;
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceUpdateRequest $request, Commerce $commerce, Service $service)
    {
        //$service = Service::findOrFail($service_id);

        $data = $request->validated();
        //
        $service->update([
            "name" => $request->name,
            "description" => $request->description,
            "price" => $request->price,
            "commerce_id" => $commerce->id,// $user->commerce->id,  
            "category_id" => $request->category_id
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
    public function destroy(Commerce $commerce ,Service $service)
    {
        $service->delete();

        return ["code" => "200", "meesage" => "Eliminado"];
    }
}
