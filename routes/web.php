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
    return view('index');
});

Route::get('/error/404', function() {
    return view('error.404');
});

Route::get('/index', 'HomeController@index');
Route::post('/index', 'RestaurantController@restaurants');
Route::get('/about', 'HomeController@about');
Route::get('/contact', 'HomeController@contact');

Route::get('/restaurants', 'RestaurantController@restaurants');
Route::post('/restaurants', 'RestaurantController@restaurants');

Route::get('/restaurants/{restaurantId}', 'RestaurantController@restaurant');

Route::get('/main', 'UserController@index');
Route::post('/main/checklogin', 'UserController@checklogin');
Route::get('main/successlogin', 'UserController@successlogin');
Route::get('main/logout','UserController@logout');

Route::get('/main/register', 'UserController@registerCreate');
Route::post('main/register', 'UserController@registerStore');