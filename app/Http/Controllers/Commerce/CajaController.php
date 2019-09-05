<?php

namespace App\Http\Controllers\Commerce;
use App\Repositories\CajaRepository;

use App\Http\Controllers\Controller;

use App\Caja;
use App\Commerce;


use Illuminate\Http\Request;

class CajaController extends Controller
{

    protected $rCaja;

    public function __construct(CajaRepository $rcaja)
    {
        $this->rCaja = $rcaja;

        $this->middleware('isAdmin', ['only' => ['store','update','destroy']]); 
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
        $result = $this->rCaja->store($request->name,$request->total,$commerce->id);

        return ["code" => "200", "message" =>"success", "data" => $result];
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
        $result = $this->rCaja->update($caja);

        return ["code" => "200", "message" =>"success", "data" => $result];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Caja  $caja
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commerce $commerce ,Caja $caja)
    {
        $result = $this->rCaja->destroy($caja);

        return ["code" => "200", "message" =>"success", "data" => $result];
    }
    
    public function cerrar(Request $request,$commerce_id, $caja_id){

        $result =  $this->rCaja->Closing($caja_id,$request->extracted);

        return ["code" => "200", "message" =>"success", "data" => $result];
    }
}
