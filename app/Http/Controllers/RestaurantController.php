<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Auth;
use App\Restaurant;
use App\Order;
use App\OrderLine;
use App\Food;
use App\Review;
use Session;
use Illuminate\Database\Eloquent\Collection;
use Redirect;
use Illuminate\Database\QueryException;

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

    public function addReview($restaurantId, Request $request)
    {
        $show_foods = false;
        $restaurant = Restaurant::findOrFail($restaurantId);                
        $this->validate(request(), [
            'title' => 'required',
            'comment' => 'required' ,
            'score' => 'required|numeric',                
        ]);

        $review = new Review;
        $review->title = request('title');
        $review->comment = request('comment');
        $review->score = request('score');
        $review->restaurant_id = $restaurantId;
        $review->user_id = Auth::user()->id;

        try{
            Review::createReview($review);
        }catch(QueryException $qe)
        {            
            return Redirect::back()->with([
                'restaurantId'                
            ])->withErrors('You have already created a review for this restaurant.');
        }

        return view('restaurant.restaurant', [
            'restaurant' => $restaurant,
            'order' => Session::get('order'),
            'show_foods' => $show_foods
        ]);
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
                        
                        return redirect()->to('/addRestaurants');
                        break;
                    default:
                        # code...
                        break;
                }
                return view('home.about');
            }
        }
        catch(Exception $e)
        {
            Redirect::back()->withErrors("Error to chungo.");
        }
        return view('restaurant.addRestaurants');
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

    public function editFood($restaurantId, $foodId, Request $request)
    {                
        $button_action = request('food-btn');
        $food = Food::find($foodId);               
        if(is_null($food) && strcmp($button_action,'create') != 0)                   
            return redirect('/restaurants/'.$restaurantId);        

        switch($button_action)
        {
            case 'delete':
                Food::deleteFood($food->id);                
                return redirect('/restaurants/'.$restaurantId);       
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

                try
                {
                    Food::createFood($food_new);  
                }catch(QueryException $qe)
                {                                 
                    return redirect()->back()->with([
                        'restaurantId',
                        'foodId',
                        'request',
                    ])->withErrors('There is a food with that name taken.');    
                }

                $food = $food_new;                              
                break;   
            
            default:;
        }

        $restaurant = Restaurant::findOrFail($restaurantId);            
        return view('restaurant.editFood', compact(['food','restaurant']));
    }
}
