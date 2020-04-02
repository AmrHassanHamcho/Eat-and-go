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
use Redirect;

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

    public function addRestaurants(Request $request)
    {
        $listRestaurants = [];
        try
        {   
            $action = request('form_btn');
            if (!is_null($action)){
                
                switch ($action) {
                    case 'create':
                        $this->validate(request(), [
                            'name' => 'required',
                            'bank_account' => 'min:10|max:12' ,
                            'phone' => 'min:9|max:11',
                            'admin' => 'numeric',
                        ]);
                                
                        $restaurant = new Restaurant;

                        $restaurant->name = request('name');
                        $restaurant->address = request('address');
                        $restaurant->bank_account = request('bank_account');
                        $restaurant->phone = request('phone');
                        $restaurant->number_reviews = 0;
                        $restaurant->image_url = '/img/justeat.png';
                        $restaurant->admin_id = request('admin');

                        Restaurant::createRestaurant($restaurant);
                        return redirect()->to('/addRestaurants');
                        break;

                    case 'read':
                        $this->validate(request(), [
                            'name' => 'required',
                        ]);

                        $name = request('name');

                        $listRestaurants = Restaurant::readRestaurantByName($name);
                        //dd($listRestaurants);
                        return view('restaurant.addRestaurants', [
                            'listRestaurants' => $listRestaurants,
                        ]);

                        //return redirect()->to('/addRestaurants');
                        break;
                    default:
                        # code...
                        break;
                }
            }
        }
        catch(Exception $e)
        {
            Redirect::back()->withErrors("Error to chungo.");
        }
        return view('restaurant.addRestaurants', [
            'listRestaurants' => $listRestaurants,
        ]);
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
}
