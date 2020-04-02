<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Auth;
use App\Restaurant;
use App\Order;
use App\OrderLine;
use App\Food;
use Session;
use Illuminate\Database\Eloquent\Collection;

class RestaurantController extends Controller
{
    public function __construct()
    {            
        $this->middleware('auth');            
    }

    public function restaurant($restaurantId)
    {        
        $address = Session::get('address');
                
        if(is_null($address))
            return redirect('/address');

        $restaurant = new Restaurant;
        $show_foods = true;

        try        
        {                          
            $restaurant = Restaurant::findOrFail($restaurantId);            
            $order = Session::get('order');                         
                
            if($restaurant->id != $order->restaurant_id || is_null($order->restaurant_id))
            {                                
                $order->orderlines = new Collection;
                $order->restaurant_id = $restaurant->id;                        
            }

            return view('restaurant.restaurant', [
                'restaurant' => $restaurant,
                'order' => $order,
                'show_foods' => $show_foods
            ]);
        }
        catch (Exception $e)
        {            
            abort('404');
        }                
    }       

    public function reviews($restaurantId)
    {        
        $address = Session::get('address');
                
        if(is_null($address))
            return redirect('/address');

        $restaurant = new Restaurant;
        $show_foods = false;

        try
        {
            $restaurant = Restaurant::findOrFail($restaurantId);            

            return view('restaurant.restaurant', [
                'restaurant' => $restaurant,
                'order' => Session::get('order'),
                'show_foods' => $show_foods
            ]);
        }
        catch (Exception $e)
        {
            abort('404');
        }                
    } 

    public function restaurants()
    {                
        $address = Session::get('address');
                
        if(is_null($address))
            return redirect('/address');

        $this->emptyOrder();
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

        return view('restaurant.restaurants', [
            'listRestaurants' => $listRestaurants,
            'address' => $address
        ]);
    }

    public function editRestaurant()
    {
        $this->emptyOrder();
        return view('restaurant.editRestaurant');
    }

    public function addRestaurant()
    {
        $this->emptyOrder();
        return view('restaurant.addRestaurant');
    }

    private function emptyOrder() 
    {
        $order = Session::get('order');             
        if(!is_null($order))
        {
            $order->total_price = 0.0;
            $order->orderlines = new Collection;
        }
    }

    public function addfood($restaurantId)
    {
        $food = Food::find(request('food_id'));         
        $order = Session::get('order');                  

        if(!is_null($food))
        {
            $orderline = new OrderLine;
            $orderline->food_id = $food->id;
            $orderline->total_price = $food->price;
            $orderline->quantity = 1;            
            
            $order->addOrderLine($orderline);
        } 

        return redirect('/restaurants/'.$restaurantId);
    }

    public function removefood($restaurantId)
    {        
        $food = Food::find(request('food_id'));       
        $order = Session::get('order');                  

        if(!is_null($food))
        {
            $orderline = new OrderLine;
            $orderline->food_id = $food->id;

            $order->removeOrderLine($orderline);
        } 

        return redirect('/restaurants/'.$restaurantId);
    }   

    public function editFood($restaurantId, Request $request)
    {
        $food = Food::find(request('food_id'));       
        $button_action = request('food-btn');

        if(is_null($food))                    
            return redirect('/restaurants/'.$restaurantId);        

        switch($button_action)
        {
            case 'delete':
                Food::deleteFood($food->id);                
                break;

            case 'edit':
                if(!is_null(request('name')))                
                    $food->name = request('name');
                
                if(!is_null(request('description')))                                    
                    $food->description = request('description');
                
                if(!is_null(request('price')))                                    
                    $food->price = request('price');

                $food->updateFood();                
                break;            
            
            case 'create':
                $this->validate($request, [
                    'name' => 'required',
                    'description' => 'required' ,
                    'price' => 'required|numeric'
                ]);
                $food_new = new Food;
                $food_new->name = request('name');
                $food_new->description = request('description');
                $food_new->price = request('price');
                $food_new->restaurant_id = $restaurantId;

                Food::createFood($food_new);  
                $food = $food_new;              
                
                break;   
        }

        $restaurant = Restaurant::findOrFail($restaurantId);            
        return view('restaurant.editFood', compact(['food','restaurant']));
    }
}
