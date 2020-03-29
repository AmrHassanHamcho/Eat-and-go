<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Restaurant;

class RestaurantController extends Controller
{
    public function restaurant($restaurantId)
    {        
        $restaurant = new Restaurant;

        try
        {
            $restaurant = Restaurant::findOrFail($restaurantId);
            // $success = $restaurant->readRestaurant((int)$restaurantId);
            // if(!$success)
            //     return view('error.404');
            
            return view('restaurant.restaurant', compact('restaurant'));
        }
        catch (Exception $e)
        {
            return view('error.404');
        }                
    }       

    public function restaurants()
    {
        $listRestaurants = Restaurant::listRestaurants(true);
        return view('restaurant.restaurants', compact('listRestaurants'));
    }

    public function editRestaurant()
    {
        return view('restaurant.editRestaurant');
    }

    public function addRestaurant()
    {
        return view('restaurant.addRestaurant');
    }
}
