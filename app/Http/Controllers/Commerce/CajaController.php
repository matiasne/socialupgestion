<?php

namespace App\Http\Controllers\Commerce;
use App\Repositories\CajaRepository;

use App\Http\Controllers\Controller;

use App\Caja;
use App\Commerce;


use Illuminate\Http\Request;

class CajaController extends Controller
{

    protected $rPcaja;

    public function __construct(CajaRepository $rcaja)
    {
        $this->rPcaja = $rcaja;
    }

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

        //!!!! Aca borrar todos los ingresos e egresos de caja
        
        return ["code" => "200", "meesage" => "Eliminado"];
    }
    
    public function cerrar(Request $request,$commerce_id, $caja_id){

        return $this->rPcaja->Closing($caja_id,$request->extracted);
    }
}
