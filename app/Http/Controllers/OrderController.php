<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Order;
use App\OrderLine;
use App\Food;
use App\Restaurant;
use App\User;

class OrderController extends Controller
{
    public function summary(/**$orderId */){
        $order = new Order;
        /** 
        try{
            //$order = findOrFail($orderId);
        */
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
            $order->total_price = 30;

            return view('order.summary', compact('order'));

        /** 
        }
        catch(Exception $e){
            return view('error404');
        }
        */
    }
}
