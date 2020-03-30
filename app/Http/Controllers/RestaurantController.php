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
