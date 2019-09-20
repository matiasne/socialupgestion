<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login')->middleware('cors');
    Route::post('signup', 'AuthController@signup')->middleware('cors');
  
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout')->middleware('cors');
        Route::get('user', 'AuthController@user')->middleware('cors');
    });
});

Route::group(['middleware' => 'auth:api'], function() {
        
    //Route::apiResource('users','UserController');
    
    Route::post('users/search','UserController@search');

    Route::apiResource('messages','MessageController');
   
    Route::apiResource('commerces','Commerce\CommerceController');

    Route::group(['middleware' => 'belongs'], function() {

        Route::apiResource('commerces.sales','Commerce\SaleController');
        Route::apiResource('commerces.subscriptions','Commerce\SubscriptionController');
        
        //Esto podría hacer el dueño
        Route::apiResource('commerces.clients','Commerce\ClientController');   
        Route::apiResource('commerces.products','Commerce\ProductController'); 
        Route::apiResource('commerces.services','Commerce\ServiceController');
        Route::apiResource('commerces.categories','Commerce\CategoryController');    
        Route::apiResource('commerces.providers','Commerce\ProviderController'); 
        //Route::apiResource('commerces.employes','Commerce\EmployeController');       
        Route::apiResource('commerces.payments','Commerce\PaymentController');
        Route::apiResource('commerces.paydesks','Commerce\PaydeskController');    

        //Esto podria hacer el empleado
        

    });
    
    Route::group(['middleware' => 'idBelongs'], function() {
        Route::get('commerces/{commerce_id}/paydesks/{paydesk_id}/close','Commerce\PaydeskController@cerrar');

        Route::post('commerces/{commerce_id}/employees/{id}','UserController@setEmployeeRole');
    });
});

