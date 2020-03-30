<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Restaurant;
use App\Order;
use App\OrderLine;
use App\Food;

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
            $order = new Order;

            $orderline = new OrderLine;
            $orderline->food_id = 1;
            $orderline->total_price = $orderline->food->price;
            $orderline->quantity = 1;

            $orderline2 = clone $orderline;
            $orderline2->food = new Food;
            $orderline2->food->name = "Bocata de lomo fresco con queso";

            $orderline3 = clone $orderline;
            $orderline3->food = new Food;
            $orderline3->food->name = "Pastel de carne de la EPS";

            $order->orderlines = [$orderline, $orderline2, $orderline3];
            return view('restaurant.restaurant', [
                'restaurant' => $restaurant,
                'order' => $order,
            ]);
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
