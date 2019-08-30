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
    protected $salerepo;

    public function __construct(SaleRepository $pagare)
    {
        $this->salerepo = $pagare;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Commerce $commerce)
    {
        return $this->salerepo->getall($commerce);
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
      
       return $this->salerepo->storeSale($request,$commerce);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Commerce $commerce,Sale $sale)
    {
        return $this->salerepo->getone($sale);
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
        
        return $this->salerepo->updateSale($request,$commerce,$sale);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commerce $commerce,Sale $sale)
    {
        return $this->salerepo->destroySale($sale);
    }
}
