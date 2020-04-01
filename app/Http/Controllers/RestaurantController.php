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

    public function addRestaurants(Request $request)
    {
        /*$this->validate($request, [
            'p_name' => 'required|min:6|max:50',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
    
        $project = new Project;
        $project->p_name = $request->input('p_name');
        $project->start_date = $request->input('start_date');
        $project->end_date = $request->input('end_date');
        $project->colab = $request->input('colab');*/
    
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
                            
                    $restaurant = new Restaurant;

                    $name = request('name');
                    // $restaurant->address = request('address');
                    // $restaurant->bank_account = request('bank_account');
                    // $restaurant->phone = request('phone');
                    // $restaurant->number_reviews = 0;
                    // $restaurant->image_url = '/img/justeat.png';
                    // $restaurant->admin_id = request('admin');

                    $listRestaurants = $restaurant->readRestaurantByName($name);
                    dd($restaurant);
                    return redirect()->to('/addRestaurants');
                    break;
                default:
                    # code...
                    break;
            }
            return view('home.about');
        }
        return view('restaurant.addRestaurants');
    }

}
