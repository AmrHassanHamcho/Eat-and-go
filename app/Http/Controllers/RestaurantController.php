<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;

class RestaurantController extends Controller
{
    public function restaurant()
    {
        $food = 1;
        //$food = $restaurant->foods();
        return view('restaurant.restaurant', compact('food'));
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
