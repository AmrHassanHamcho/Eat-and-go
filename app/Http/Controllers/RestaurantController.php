<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Auth;
use App\Restaurant;
use App\Order;
use App\OrderLine;
use App\Food;

class RestaurantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');       
    }

    public function restaurant($restaurantId)
    {        
        $restaurant = new Restaurant;
        $show_foods = true;

        try
        {
            $restaurant = Restaurant::findOrFail($restaurantId);            
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
                'show_foods' => $show_foods
            ]);
        }
        catch (Exception $e)
        {
            return view('error.404');
        }                
    }       

    public function reviews($restaurantId)
    {        
        $restaurant = new Restaurant;
        $show_foods = false;

        try
        {
            $restaurant = Restaurant::findOrFail($restaurantId);            
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
                'show_foods' => $show_foods
            ]);
        }
        catch (Exception $e)
        {
            return view('error.404');
        }                
    } 

    public function restaurants(){

        $filter = request('filter');
        $order = 'asc';

        switch ($filter) {
            case "name_asc":
                $filter = 'name';
                $order = 'asc';
                break;
            case "name_desc":
                $filter = 'name';
                $order = 'desc';
                break;
            case "num_reviews_asc":
                $filter = 'number_reviews';
                $order = 'asc';
                break;
            case "num_reviews_desc":
                $filter = 'number_reviews';
                $order = 'desc';
                break;
            default: 
                $filter = 'name';
                $order = 'asc';
        }

        $listRestaurants = Restaurant::listRestaurants($filter, $order);
        
        //$restaurants = factory(Restaurant::class, 3)->make();
        //$restaurant2 = factory(Restaurant::class)->make();
        //$restaurant3 = factory(Restaurant::class)->make();
        
        //$listRestaurants->push($restaurants);
        
        $address = request('address');
                
        // if(is_null($address))
        //     return redirect('/address');

        return view('restaurant.restaurants', [
            'listRestaurants' => $listRestaurants,
            'address' => $address
        ]);
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