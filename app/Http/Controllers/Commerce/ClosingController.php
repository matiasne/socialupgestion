<?php

namespace App\Http\Controllers\Commerce;
use App\Http\Controllers\Controller;
use App\Repositories\CajaRepository;

use App\Closing;
use App\Caja;

use Illuminate\Http\Request;

class ClosingController extends Controller
{
    protected $rPcaja;

    public function __construct(CajaRepository $caja)
    {
        $this->rPcaja = $caja;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request,Caja $caja)
    {
        return $this->rPcaja->Closing($caja,$request->extracted);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Closing  $closing
     * @return \Illuminate\Http\Response
     */
    public function show(Closing $closing)
    {
        //
        return $closing;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Closing  $closing
     * @return \Illuminate\Http\Response
     */
    public function edit(Closing $closing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Closing  $closing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Closing $closing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Closing  $closing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Closing $closing)
    {
        //
    }
}
