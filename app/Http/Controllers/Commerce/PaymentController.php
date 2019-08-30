<?php

namespace App\Http\Controllers\Commerce;
use App\Http\Controllers\Controller;
use App\Payment;
use App\Commerce;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Commerce $commerce)
    {
        $pay = $commerce->payments()->get();
        return $pay;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,  Commerce $commerce)
    {
        $Payment = Payment::create([
            "child_table" => $request->child_table,
            "enum_type" => $request->enum_type,
            "status" => $request->status,
            "total_cost" => $request->total_cost,
            "client_id" => $request->client_id,
            "commerce_id" => $commerce->id
        ]);     

        return ["code" => "200", "message" =>"success", "data" => $Payment];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Commerce $commerce, Payment $payment)
    {
        return $payment;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $commerce_id, $payment_id)
    {
        $payment = Payment::findOrFail($payment_id);

        $payment->update([
            "child_table" => $request->child_table,
            "enum_type" => $request->enum_type,
            "status" => $request->status,
            "total_cost" => $request->total_cost
        ]);
        $payment->save();

        return ["Status" => "200", "message" => "Actualizado", "data" => $payment];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $commerce_id, $payment_id)
    {
        $payment = Payment::findOrFail($payment_id);
        $payment->delete();
        return ["code" => "200", "meesage" => "Eliminado"];
    }
}
