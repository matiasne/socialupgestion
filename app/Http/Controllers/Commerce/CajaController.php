<?php

namespace App\Http\Controllers\Commerce;


use App\Http\Controllers\Controller;

use App\Caja;
use App\Commerce;


use Illuminate\Http\Request;

class CajaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Commerce $commerce)
    {
        return $commerce->cajas()->get();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Commerce $commerce)
    {
        $caja = Caja::create([
            "name" => $request->name,
            "commerce_id" =>  $commerce->id,
            "total" => $request->total
        ]);

        return ["code" => "200", "message" =>"success", "data" => $caja];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Caja  $caja
     * @return \Illuminate\Http\Response
     */
    public function show(Commerce $commerce,Caja $caja)
    {
        return $caja;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Caja  $caja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commerce $commerce,Caja $caja)
    {
        $caja->update([
            "name" => $request->name,
            "commerce_id" =>  $commerce->id,
            "total" => $request->total
        ]);

        $caja->save();

        return ["code" => "200", "message" =>"success", "data" => $caja];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Caja  $caja
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commerce $commerce ,Caja $caja)
    {
        $caja->delete();
        
        return ["code" => "200", "meesage" => "Eliminado"];
    }
}
