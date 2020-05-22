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

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/', 'HomeController@welcome');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/address', 'HomeController@address')->middleware('auth');
Route::post('/address', 'HomeController@addressValidation')->middleware('auth');
Route::get('/about', 'HomeController@about');
Route::get('/contact', 'HomeController@contact');

Route::get('/restaurants', 'RestaurantController@restaurants');
Route::post('/restaurants', 'RestaurantController@restaurants');

Route::get('/addRestaurants', 'RestaurantController@addRestaurants');
Route::post('/addRestaurants', 'RestaurantController@addRestaurants');
Route::get('/editRestaurant/{restaurantId}', 'RestaurantController@editRestaurant');
Route::post('/editRestaurant/{restaurantId}', 'RestaurantController@editRestaurant');

Route::get('/restaurants/{restaurantId}', 'RestaurantController@restaurant');
Route::post('/addfood/{restaurantId}', 'RestaurantController@addfood');
Route::post('/removefood/{restaurantId}', 'RestaurantController@removefood');
Route::get('/restaurants/{restaurantId}/reviews', 'RestaurantController@reviews');
Route::post('/restaurants/{restaurantId}/reviews', 'RestaurantController@addReview');
Route::get('/editFood/{restaurantId}&{foodId}', 'RestaurantController@editFood');
Route::post('/editFood/{restaurantId}&{foodId}', 'RestaurantController@editFood');
Route::get('/editReview/{restaurantId}&{reviewId}', 'RestaurantController@editReview');
Route::post('/editReview/{restaurantId}&{reviewId}', 'RestaurantController@editReview');
Route::get('/myrestaurants', 'RestaurantController@myrestaurants');

Route::post('/summary/{restaurantId}', 'OrderController@summary');
Route::post('/thanks', 'OrderController@store');
Route::get('/summary/{restaurantId}', 'OrderController@summary');
Route::get('/thanks', 'OrderController@store');
