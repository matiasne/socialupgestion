<?php

namespace App\Http\Controllers\Commerce;
use App\Http\Controllers\Controller;
use App\Repositories\ImgRepository;

use App\Product;
use App\Commerce;

use Illuminate\Http\Request;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;


class ProductController extends Controller
{   
    protected $img;

    public function __construct(ImgRepository $img)
    {
        $this->img = $img;
        $this->middleware('isAdmin', ['only' => ['store','destroy']]);  
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Commerce $commerce)
    {   
        $products = $commerce->products()->get();
        return $products;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request, Commerce $commerce)
    {       
        $data = $request->validated();

        $prod = Product::create([
            "name" => $request->name,
            "description" => $request->description,
            "stock" => $request->stock,
            "price" => $request->price,
            "code"=>$request->code,
            "commerce_id" =>  $commerce->id,  
            "provider_id" => $request->provider_id,
            "category_id" => $request->category_id,
            "imgproduct" => $this->img->imgProduct($request),
        ]);     
            
        return ["code" => "200", "message" =>"success", "data" => $prod];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Commerce $commerce, Product $product)
    {
        return $product;
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, Commerce $commerce, Product $product)
    {
       /*
        $file = $request->url_img;
        
        // La imagen la subiremos a un directorio llamado 'uploads', el cual creamos manualmente en nuestro servidor
        $file->move('img', $file->getClientOriginalName());

        $filename = $file->getClientOriginalName();*/

    
        $product->update([
            "name" => $request->name,
            "description" => $request->description,
            "stock" => $request->stock,
            "price" => $request->price,
            "code"=>$request->code,
            "commerce_id" => $commerce->id,// $user->commerce->id,  
            "provider_id" => $request->provider_id,
            "category_id" => $request->category_id,
            "imgproduct" => 'http://localhost/socialupgestion/public/img/'
        ]);
        
        $product->save();

        return ["code" => "200", "message" => "Actualizado", "data" => $product];
    }

    public function destroy(Commerce $commerce, Product $product)
    {
        $product->delete();

        return ["code" => "200", "meesage" => "Eliminado"];
    }

   
}
