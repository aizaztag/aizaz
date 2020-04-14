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
    //echo htmlspecialchars(request('name')); //http://127.0.0.1:8000/?name=%3Cscript%3Ealert(%27dfdf%27)%3C/script%3E
    return view('welcome');
});

//Route::get('/{post}', 'PostController@show');


Route::get('/products', 'ProductController@create')->name('products.create');
Route::post('/products/create', 'ProductController@store')->name('products.store');


