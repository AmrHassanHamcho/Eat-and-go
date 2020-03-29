<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Restaurant;

class RestaurantController extends Controller
{
    public function restaurant($restaurantId)
    {        
        // $restaurant = new Restaurant;

        // try
        // {
        //     $success = $restaurant->readRestaurant((int)$restaurantId);
        //     if(!$success)
        //         return abort(404);
        // }
        // catch (Exception $e)
        // {
            
        // }
        
        return view('restaurant.restaurant', compact('restaurant'));
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
