<?php

namespace App\Http\Controllers\Commerce;
use App\Http\Controllers\Controller;
use App\Repositories\SaleRepository;

use App\Sale;
use App\Commerce;
use App\Product;

use Illuminate\Http\Request;
use App\Http\Requests\SaleStoreRequest;
use App\Http\Requests\SaleUpdateRequest;

class SaleController extends Controller
{
    protected $rSale;

    public function __construct(SaleRepository $rSale)
    {
        $this->rSale = $rSale;
        $this->middleware('isAdmin', ['only' => ['update','destroy']]); 
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Commerce $commerce)
    {
        return $this->rSale->getall($commerce);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleStoreRequest $request, Commerce $commerce)
    {   
       $data = $request->validated();
      
       $result = $this->rSale->storeSale($request,$commerce);

       return ["code" => "200", "message" =>"success", "data" => $result];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Commerce $commerce,Sale $sale)
    {
        return $this->rSale->getone($sale);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(SaleUpdateRequest $request, Commerce $commerce,Sale $sale)
    {
        
        $data = $request->validated();
        
        $result =  $this->rSale->updateSale($request,$commerce,$sale);

        return ["code" => "200", "message" =>"success", "data" => $result];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commerce $commerce,Sale $sale)
    {
        $result =  $this->rSale->destroySale($sale);

        return ["code" => "200", "message" =>"success", "data" => $result];
    }
}
