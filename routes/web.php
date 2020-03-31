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
    return view('welcome');
});

Route::get('/error/404', function() {
    return view('error.404');
});

Route::get('/about', 'HomeController@about');
Route::get('/contact', 'HomeController@contact');

Route::get('/restaurants', 'RestaurantController@restaurants');
Route::get('/restaurants/{restaurantId}', 'RestaurantController@restaurant');

Route::get('/summary', 'OrderController@summary');
Route::get('/thanks', function (){
    return view('order.thanks');
});
