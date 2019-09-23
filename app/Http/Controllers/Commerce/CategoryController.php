<?php
namespace App\Http\Controllers\Commerce;
use App\Http\Controllers\Controller;

use App\Commerce;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryStoreRequest;

class CategoryController extends Controller
{

    public function __construct()
    {
        
        $this->middleware('isAdmin', ['only' => ['store','update','destroy']]); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Commerce $commerce)
    {
        //
         //
        $categories = $commerce->categories()->get();
        return $categories;
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request, Commerce $commerce)
    {
        $category = new Category;
        $category->name = $request->name;
        $category->commerce_id =  $commerce->id;
        

        return ["code" => "200", "message" =>"success", "data" => $category];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Commerce $commerce,Category $category)
    {
        //
        return $category;
    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $commerce_id, $category_id)
    {
        //
        $category = Category::findOrFail($category_id);

        $category->update([
            "name" => $request->name,
            "commerce_id" =>  $request->commerce_id,  
        ]);
        
        $category->save();

        return ["code" => "200", "message" => "Actualizado", "data" => $category];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commerce $commerce,Category $category)
    {
        
        $category->delete();
        return ["code" => "200", "meesage" => "Eliminado"];
    }
}
