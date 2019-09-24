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
		return "Welcome Everyone";
});


Route::get('/test', function () {

		return view('test');
});
Route::post('/addorder','orderController@store');

Route::get('/showorders','orderController@show');
Route::get('/manage','orderController@create');

Route::post('/destroy','orderController@destroy');
Route::post('/edit','orderController@edit');



?>
