<?php

namespace App\Http\Controllers\Commerce;
use App\Http\Controllers\Controller;
use App\Repositories\PaymentRepository;

use App\Payment;
use App\Commerce;
use Illuminate\Http\Request;

class PaymentController extends Controller
{   
    protected $rPaym;

    public function __construct(PaymentRepository $paym)
    {
        $this->rPaym = $paym;
    }

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
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Commerce $commerce, Payment $payment)
    {
        return $payment;
    }

    public function update(Commerce $commerce, Payment $payment)
    {
        $data = $request->all();
        $pay = $commerce->updatePayments($data,$payment)->get();

        return $payment;
    }


   
}
