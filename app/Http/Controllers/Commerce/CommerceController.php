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
    protected $rimg;

    public function __construct(ImgRepository $rimg)
    {
        $this->rimg = $rimg;
        $this->middleware('isAdmin', ['only' => ['update','destroy']]); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $commerces = $request->user('api')->commerces()
            ->without('products')
            ->without('services')
            ->without('clients')
            ->without('employees')
            ->without('categories')
            ->without('providers')
            ->without('paydesks')
            ->get();
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

        $commerce = new Commerce;
        
        $commerce->name = $request->name;
        $commerce->address = $request->address;
        $commerce->phone_number = $request->phone_number;
        $commerce->img = $request->img;
        $commerce->latitud = $request->latitud;
        $commerce->longitud = $request->longitud;
        $commerce->description = $request->description;
        $commerce->email = $request->email;             
       

        $request->user('api')->commerces()->attach($commerce->id, [
            'enum_rol' => "ADMIN",
            'enum_status' => "DESCONECTADO"
        ]);

        $commerce->save();

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

      /*  $file = $request->img;
        
        // La imagen la subiremos a un directorio llamado 'uploads', el cual creamos manualmente en nuestro servidor
        $file->move('img', $file->getClientOriginalName());

        $filename = $file->getClientOriginalName();*/

        $commerce->update([
            "name" => $request->name,
            "address" => $request->address,
            "phone_number" => $request->phone_number,
            "latitud" => $request->latitud,
            "longitud" => $request->longitud,
            "description" => $request->description,
            "email" => $request->email,
            "img" => 'http://localhost/socialupgestion/public/img/'
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
        $commerce->products()->delete();
        $commerce->users()->detach();
        $commerce->clients()->delete();
        $commerce->categories()->delete();
        $commerce->providers()->delete();
        $commerce->sales()->delete();
        $commerce->subscription()->delete();
        $commerce->services()->delete();
        $commerce->paydesks()->delete();
        $commerce->payments()->delete();

        $commerce->delete();
        return ["code" => "200", "meesage" => "Eliminado"];
    }

    
}
