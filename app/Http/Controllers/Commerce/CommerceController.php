<?php
namespace App\Http\Controllers\Commerce;
use App\Http\Controllers\Controller;

use App\Commerce;
use Illuminate\Http\Request;
use App\Http\Requests\CommerceStoreRequest;

class CommerceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $commerces = $request->user('api')->commerces()->get();
        return $commerces;
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
    public function store(CommerceStoreRequest $request)
    {
        
        $commerce = $request->user('api')->commerces()->create([
            "name" => $request->name,
            "address" => $request->address,
            "phone_number" => $request->phone_number,    
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
            "phone_number" => $request->phone_number,
        ]);
        
        $commerce->save();

        
        return ["code" => "200", "message" => "Actualizado", "data" => $commerce];
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
