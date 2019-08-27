<?php
namespace App\Http\Controllers\Commerce;
use App\Http\Controllers\Controller;

use App\Provider;
use Illuminate\Http\Request;
use App\Http\Requests\ProviderStoreRequest;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         //
        $providers = $commerce->categories()->get();
        return $providers;
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
    public function store(ProvidersStoreRequest $request, Commerce $commerce)
    {
        $provider = Provider::create([
            "name" => $request->name,
            "commerce_id" =>  $commerce_id->id,  
        ]);     

        return ["code" => "200", "message" =>"success", "data" => $provider];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show(Commerce $commerce,Provider $provider)
    {
        //
        return $provider;
    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $commerce_id, $provider_id)
    {
        //
        $provider = Provider::findOrFail($provider_id);

        $provider->update([
            "name" => $request->name,
            "commerce_id" =>  $request->commerce_id,  
        ]);
        
        $provider->save();

        return ["code" => "200", "message" => "Actualizado", "data" => $provider];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy($commerce_id,$provider_id)
    {
        //
        $provider = Provider::findOrFail($provider_id);
        $provider->delete();
        return ["code" => "200", "meesage" => "Eliminado"];
    }
}
