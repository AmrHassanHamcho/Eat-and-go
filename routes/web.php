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
Route::get('/login', 'UserController@login')->name('login');
Route::post('/checklogin', 'UserController@checklogin');
Route::get('/logout','UserController@logout');
Route::get('/register', 'UserController@create');
Route::post('/register', 'UserController@store');

Route::get('/address', 'HomeController@address')->middleware('auth');
Route::post('/address', 'HomeController@addressValidation')->middleware('auth');
Route::get('/about', 'HomeController@about');
Route::get('/contact', 'HomeController@contact');

Route::get('/restaurants', 'RestaurantController@restaurants');
Route::post('/restaurants', 'RestaurantController@restaurants');

Route::get('/addRestaurants', 'RestaurantController@addRestaurants');
Route::post('/addRestaurants', 'RestaurantController@addRestaurants');

Route::get('/restaurants/{restaurantId}', 'RestaurantController@restaurant');
Route::post('/addfood/{restaurantId}', 'RestaurantController@addfood');
Route::post('/removefood/{restaurantId}', 'RestaurantController@removefood');
Route::get('/restaurants/{restaurantId}/reviews', 'RestaurantController@reviews');
Route::get('/editFood/{restaurantId}&{foodId}', 'RestaurantController@editFood');
Route::post('/editFood/{restaurantId}&{foodId}', 'RestaurantController@editFood');

Route::post('/summary/{restaurantId}', 'OrderController@summary');
Route::post('/thanks', 'OrderController@store');
Route::get('/summary/{restaurantId}', 'OrderController@summary');
Route::get('/thanks', 'OrderController@store');

Route::get('/error/404', function() {
    return view('error.404');
});