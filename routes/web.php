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
Route::get('/', 'UserController@login');
Route::get('/login', 'UserController@login');
Route::post('/checklogin', 'UserController@checklogin');
Route::get('/logout','UserController@logout');
Route::get('/register', 'UserController@create');
Route::post('/register', 'UserController@store');

Route::get('/address', 'HomeController@address');
Route::post('/address', 'RestaurantController@restaurants');
Route::get('/about', 'HomeController@about');
Route::get('/contact', 'HomeController@contact');

Route::get('/restaurants', 'RestaurantController@restaurants');
Route::post('/restaurants', 'RestaurantController@restaurants');
Route::get('/restaurants/{restaurantId}', 'RestaurantController@restaurant');

Route::get('/error/404', function() {
    return view('error.404');
});