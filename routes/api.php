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

Route::group(['namespace' => "API"], function(){
    Route::group(['prefix' => 'recipes'], function(){
        Route::post('/', 'RecipesController1@store');
        // Route::get('/', 'RecipesController@index');
        // Route::get('/{id}', 'RecipesController@show');
        Route::post('/{id}', 'RecipesController1@uploadImage');
        Route::put('/{id}', 'RecipesController1@put');
        Route::get('/category/{id}', 'RecipesController1@getByCategory');
        // Route::delete('/{id}', 'RecipesController@destroy');
    });
});