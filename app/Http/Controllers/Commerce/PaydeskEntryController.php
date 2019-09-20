<?php
namespace App\Http\Controllers\Commerce;
use App\Http\Controllers\Controller;
use App\Repositories\PaydeskRepository;

use App\PaydeskEntry;
use App\Commerce;

use Illuminate\Http\Request;

class PaydeskEntryController extends Controller
{   
    

    public function __construct(ImgRepository $img)
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PaydeskEntry  $Paydeskentry
     * @return \Illuminate\Http\Response
     */
    public function show(PaydeskEntry $paydeskEntry)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PaydeskEntry  $paydeskEntry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaydeskEntry $paydeskEntry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PaydeskEntry  $paydeskEntry
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaydeskEntry $paydeskEntry)
    {
        //
    }
}
