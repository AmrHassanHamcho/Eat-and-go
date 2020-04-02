<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Order;
use App\OrderLine;
use App\Food;
use App\Restaurant;
use App\User;
use Session;
use Illuminate\Database\Eloquent\Collection;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');       
    }

    public function summary($restaurantId){
        $order = Session::get('order');    
        
        if($order->orderlines->count() <= 0)
            return redirect('/restaurants/'.$restaurantId);

        return view('order.summary', compact('order'));        
    }

    public function store()
    {
        $order = Session::get('order');
        if($order->orderlines->count() <= 0)
            return redirect('/restaurants/');

        Order::createOrder($order);
        
        return view('order.thanks');
    }
}
