<?php

namespace App\Http\Controllers;

use App\Commerce;
use Illuminate\Http\Request;

class CommerceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $commerce = Commerce::get();
        return $commerce;
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
    public function store(Request $request)
    {
        //Obtener usuario logueado
        //
        $commerce = Commerce::create([
            "name" => $request->name,
            "address" => $request->address,
            "phone_numebr" => $request->phone_numebr,
           
        ]);     

        return ["code" => "200", "message" =>"success", "data" => $commerce];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Commerce  $commerce
     * @return \Illuminate\Http\Response
     */
    public function show(Commerce $commerce)
    {
        //
        return $commerce;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Commerce  $commerce
     * @return \Illuminate\Http\Response
     */
    public function edit(Commerce $commerce)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Commerce  $commerce
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commerce $commerce)
    {
        //
        $commerce->update([
            "name" => $request->name,
            "address" => $request->address,
            "phone_number" => $request->phone_numebr,
        ]);
        
        $commerce->save();

        return ["Status" => "200", "message" => "Actualizado", "data" => $commerce];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Commerce  $commerce
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commerce $commerce)
    {
        //
        $commerce->delete();
        return ["code" => "200", "meesage" => "Eliminado"];
    }
}
