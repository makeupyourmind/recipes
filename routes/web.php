<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('users');
});

Route::get('/signUp', function(){
    return view('pages.signUp');
});

Route::get('/login', function(){
    return view('pages.login');
});

Route::group(['namespace' => 'API'], function(){
    Route::any('recipes/category', 'RecipesController@search');
    Route::resource('recipes', 'RecipesController');
    
    Route::any('category', 'UserRecipeController@search');
    Route::resource('users', 'UserRecipeController');
});

Route::get('/contact', function () {
    return view('pages.contactForm');
});

Route::group(['namespace' => "API"], function(){
    Route::post('/signUp', 'UserController@singUp');
    Route::post('/login', 'UserController@login');
    Route::post('/logout', 'UserController@logout');
});