<?php

namespace App\Http\Controllers;
use App\Http\Controllers;
use App\Repositories\PaymentRepository;

use App\User;
use App\Commerce;
use App\Notifications;
use Illuminate\Http\Request;

class UserController extends Controller
{   
    

    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }   

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
    }

    public function setEmployeeRole($commerce_id,$id)
    {
        $commerce = Commerce::findOrFail($commerce_id);
        $commerce->users()->attach($id, [
            'enum_rol' => "EMPLOYEE",
            'enum_status' => "DESCONECTADO"
        ] );

        return ["code" => "200", "message" =>"success", "data" => "OK"];
        
    }

    public function search(Request $request){

        if($request->search == "")
            return ["code" => "201", "message" =>"success", "data" => ""];

        $result = User::where('email', 'LIKE', '%'.$request->search.'%')->get();
        return ["code" => "200", "message" =>"success", "data" => $result];
    }


   
}
