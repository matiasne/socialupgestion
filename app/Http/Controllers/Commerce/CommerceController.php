<?php
namespace App\Http\Controllers\Commerce;
use App\Http\Controllers\Controller;
use App\Repositories\ImgRepository;

use App\Commerce;

use Illuminate\Http\Request;
use App\Http\Requests\CommerceStoreRequest;
use App\Http\Requests\CommerceUpdateRequest;

class CommerceController extends Controller
{   
    protected $img;

    public function __construct(ImgRepository $img)
    {
        $this->img = $img;
    }

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommerceStoreRequest $request)
    {
        $data = $request->validated();

        $commerce = $request->user('api')->commerces()->create([
            "name" => $request->name,
            "address" => $request->address,
            "phone_number" => $request->phone_number,
            "imgcommerce"  => $this->img->imgCommerce($request)
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Commerce  $commerce
     * @return \Illuminate\Http\Response
     */
    public function update(CommerceUpdateRequest $request, Commerce $commerce)
    {
        $data = $request->validated();

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
