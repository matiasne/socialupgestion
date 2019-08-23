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

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
 */


 Route::apiResource('products','ProductController');
 Route::apiResource('services','ServiceController');
 Route::apiResource('category','CategoryController');
 Route::apiResource('commerces','CommerceController');
 Route::apiResource('providers','ProviderController');
 Route::apiResource('users','UserController');
 Route::apiResource('rols','RolController');