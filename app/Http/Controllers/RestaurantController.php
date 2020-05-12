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
use Illuminate\Support\Facades\Validator;

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
            $review = Review::where("user_id", Auth::user()->id)->where("restaurant_id", $restaurantId)->first();

            return redirect('/editReview/'.$restaurantId.'&'.$review->id)                
            ->withErrors('You had already created this review for this restaurant. You can edit it.');
        }

        $restaurant = Restaurant::findOrFail($restaurantId); 
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

    public function editRestaurant(Request $request, $restaurantId)
    {
        
        $restaurant = Restaurant::findOrFail($restaurantId);
        if(Auth::user()->id != $restaurant->admin_id && !Auth::user()->isAdminApp())
        {
            return redirect('logout');
        }

        try        
        {                          
            $button_action = request('restaurant-btn');           

            switch($button_action)
            {
                case 'delete':
                    Restaurant::deleteRestaurant($restaurant->id);                
                    return redirect('/addRestaurants');       
                    break;

                case 'edit':
                    if(!is_null(request('name')))                               
                        $restaurant->name = request('name');
                    
                    if(!is_null(request('address')))                                    
                        $restaurant->address = request('address');
                    
                    if(!is_null(request('bank_account')))                                    
                        $restaurant->bank_account = request('bank_account');
                    
                    if(!is_null(request('phone')))                                    
                        $restaurant->phone = request('phone');

                    if(!is_null(request('image')))
                    {     
                        $imageName = $request->image->getClientOriginalName();  
                        $restaurant->image_url = '/img/'.$imageName;
                        
                    }
                    $restaurant->updateRestaurant();  
                    
                    if(!is_null(request('image')))
                    {
                        $imageName = $request->image->getClientOriginalName();  
                        $request->image->move(public_path('img'), $imageName);
                    }
                    break;            
                
                case 'create':

                    $validator = Validator::make($request->all(), [
                        'name' => 'required',
                        'address' => 'required',
                        'bank_account' => 'required' ,
                        'phone' => 'required',
                    ]);
                    if ($validator->fails()) { 
                        Redirect::back()->withErrors("Introduce all restaurant information please!");
                    }

                    $restaurant = new Restaurant;

                    $restaurant->name = request('name');
                    $restaurant->address = request('address');
                    $restaurant->bank_account = request('bank_account');
                    $restaurant->phone = request('phone');
                    $restaurant->number_reviews = 0;
                    $restaurant->admin_id = 2;
                    if(!is_null(request('image')))
                    {     
                        $imageName = $request->image->getClientOriginalName();  
                        $restaurant->image_url = '/img/'.$imageName;          
                    }
                    else
                    {
                        $restaurant->image_url = '/img/justeat.png';
                    }

                    Restaurant::createRestaurant($restaurant);  

                    if(!is_null(request('image')))
                    {
                        $imageName = $request->image->getClientOriginalName();  
                        $request->image->move(public_path('img'), $imageName);
                    }                             
                    break;   
                
                default:;
            }

            $restaurant = Restaurant::findOrFail($restaurantId);            
            return view('restaurant.editRestaurant', compact(['restaurant']));
 
        }
        catch(Exception $e)
        {
            return redirect()->back()->with([
                'restaurantId',
                'request',
            ])->withErrors('Unknown errors during operation!'); 
        }

        
    }

    public function addRestaurants(Request $request)
    {
        if(!Auth::user()->isAdminApp())
        {
            return redirect('logout');
        }
        $listRestaurants = [];
        try
        {   
            $action = request('form_btn');
            if (!is_null($action)){
                
                switch ($action) {
                    case 'create':
                        $validator = Validator::make($request->all(), [
                            'name' => 'required',
                            'address' => 'required',
                            'bank_account' => 'required' ,
                            'phone' => 'required',
                        ]);
                        if ($validator->fails()) { 
                            Redirect::back()->withErrors("Introduce all restaurant information please!");
                        }
                        $restaurant = new Restaurant;

                        $restaurant->name = request('name');
                        $restaurant->address = request('address');
                        $restaurant->bank_account = request('bank_account');
                        $restaurant->phone = request('phone');
                        $restaurant->number_reviews = 0;
                        $restaurant->admin_id = 2;
                        if(!is_null(request('image')))
                        {     
                            $imageName = $request->image->getClientOriginalName();  
                            $restaurant->image_url = '/img/'.$imageName;          
                        }
                        else
                        {
                            $restaurant->image_url = '/img/justeat.png';
                        }

                        Restaurant::createRestaurant($restaurant);
                        if(!is_null(request('image')))
                        {
                            $imageName = $request->image->getClientOriginalName();  
                            $request->image->move(public_path('img'), $imageName);
                        }

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
            Redirect::back()->withErrors("Error during the operation!");
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

    public function editFood($restaurantId, $foodId, Request $request)
    {                
        $restaurant = Restaurant::findOrFail($restaurantId);
        if(Auth::user()->id != $restaurant->admin_id && !Auth::user()->isAdminApp())
        {
            return redirect('logout');
        }
        $button_action = request('review-btn');
        $food = Food::find($foodId);               
        if(is_null($food) && strcmp($button_action,'create') != 0)                   
            return redirect('/restaurants/'.$restaurantId);        

        try
        {
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

                    Food::createFood($food_new);  

                    $food = $food_new;                              
                    break;   
                
                default:;
            }
        }
        catch(QueryException $qe)
        {                                 
            return redirect()->back()->with([
                'restaurantId',
                'foodId',
                'request',
            ])->withErrors('There is a food with that name taken.');    
        }

        $restaurant = Restaurant::findOrFail($restaurantId);            
        return view('restaurant.editFood', compact(['food','restaurant']));
    }

    public function editReview($restaurantId, $reviewId, Request $request)
    {                
        $restaurant = Restaurant::findOrFail($restaurantId);
        $review = Review::findOrFail($reviewId);
        
        if(Auth::user()->id != $review->user->id)
        {
            return redirect('/restaurants/'.$restaurantId.'/reviews');      
        }

        $button_action = request('review-btn');              

        try
        {
            switch($button_action)
            {
                case 'delete':
                    Review::deleteReview($review->id);                
                    return redirect('/restaurants/'.$restaurantId.'/reviews');       
                    break;

                case 'edit':
                    if(!is_null(request('title')))                
                        $review->title = request('title');
                    
                    if(!is_null(request('score')))                                    
                        $review->score = request('score');
                    
                    if(!is_null(request('comment')))                                    
                        $review->price = request('comment');

                    $review->updateReview();                
                    break;                             
                
                default:;
            }
        }
        catch(QueryException $qe)
        {                                 
            return redirect()->back()->with([
                'restaurantId',
                'reviewId',
                'request',
            ])->withErrors('There is a food with that name taken.');    
        }

        $restaurant = Restaurant::findOrFail($restaurantId);            
        return view('restaurant.editReview', compact(['review','restaurant']));
    }

    public function myrestaurants()
    {
        if(!Auth::user()->isAdminRestaurant())        
            return redirect('logout');        

        $restaurants = Auth::user()->restaurants;

        return view('restaurant.myrestaurants', [
            'restaurants' => $restaurants,            
        ]);
    }
}
