<?php

namespace App\Http\Controllers\Commerce;
use App\Http\Controllers\Controller;

use App\Commerce;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeStoreRequest;
use App\Http\Requests\EmployeUpdateRequest;

class EmployeController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin', ['only' => ['store','destroy']]);     
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Commerce $commerce)
    {      
        $emp = $commerce->employees()->get();
        return $emp;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeStoreRequest $request, Commerce $commerce)
    {   
        //Verificar si el empleado existe!!!!!!
        $commerce->users()->attach($request->employee_id, ['rol' => "EMPLOYEE"] );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function show( $commerce_id , $employe_id)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeUpdateRequest $request,$commerce_id, $employe_id)
    {   
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commerce $commerce,$employe_id)
    {
        $commerce->users()->detach($employe_id);
    }
}
