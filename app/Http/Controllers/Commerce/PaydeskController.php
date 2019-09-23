<?php

namespace App\Http\Controllers\Commerce;
use App\Repositories\PaydeskRepository;

use App\Http\Controllers\Controller;

use App\Paydesk;
use App\Commerce;


use Illuminate\Http\Request;

class PaydeskController extends Controller
{

    protected $rPaydesk;

    public function __construct(PaydeskRepository $rPaydesk)
    {
        $this->rPaydesk = $rPaydesk;

        $this->middleware('isAdmin', ['only' => ['store','update','destroy','cerrar']]); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Commerce $commerce)
    {
        return $commerce->paydesks()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Commerce $commerce)
    {
        $result = $this->rPaydesk->store($request->name,$request->amount,$commerce->id);

        return ["code" => "200", "message" =>"success", "data" => $result];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Paydesk  $Paydesk
     * @return \Illuminate\Http\Response
     */
    public function show(Commerce $commerce,Paydesk $paydesk)
    {
        return $paydesk;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Paydesk  $paydesk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commerce $commerce,Paydesk $paydesk)
    {
        $result = $this->rPaydesk->update($paydesk);

        return ["code" => "200", "message" =>"success", "data" => $result];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Paydesk  $paydesk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commerce $commerce ,Paydesk $paydesk)
    {
        $result = $this->rPaydesk->destroy($paydesk);

        return ["code" => "200", "message" =>"success", "data" => $result];
    }
    
    public function cerrar(Request $request,$commerce_id, $paydesk_id){

        $result =  $this->rPaydesk->Closing($paydesk_id,$request->extracted);

        return ["code" => "200", "message" =>"success", "data" => $result];
    }
}
