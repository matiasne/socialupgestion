<?php

namespace App\Http\Controllers;

use App\Employe;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeStoreRequest;
use App\Http\Requests\EmployeUpdateRequest;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Employe::get();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeUpdateRequest $request)
    {   


        $data = $request->validated();
        
    

        $emp = Employe::create([
            "name" => $request->name,
            "commerce_id" => $request->commerce_id,
            "surname" => $request->surname,
            "position" => $request->position
        ]);

        $emp->save();

        return ["code" => "200", "message" =>"success", "data" => $emp];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function show(Employe $employe)
    {
        return $employe;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeUpdateRequest $request, Employe $employe)
    {

        $data = $request->validated();


        $employe->update([
            "name" => $request->name,
            "commerce_id" => $request->commerce_id,
            "surname" => $request->surname,
            "position" => $request->position
        ]);
        
        $employe->save();

        return ["Status" => "200", "message" => "Actualizado", "data" => $employe];

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employe $employe)
    {
        $employe->delete();
        
        return  ["Status" => "200", "message" => "Borrado"];
    }
}
