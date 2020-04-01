<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'total_price', 'user_id', 'restaurant_id',
    ];   

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function restaurant(){
        return $this->belongsTo('App\Restaurant');
    }

    public function orderLines(){
        return $this->hasMany('App\OrderLine');
    }

    public function readOrder($id){
        if(is_int($id)){
            try{
                $order = Order::findOrFail($id);
                $this->id = $order->id;
                $this->user_id = $order->user;
                $this->restaurant_id = $order->restaurant_id;
                $this->orderLines = $order->orderLines;
                $this->total_price = $order->total_price;
                $this->created_at = $order->created_at;
                $this->updated_at = $order->updated_at;

                return true;
            }
            catch(ModelNotFoundException $e){
                return false;
            }
        }
        
        throw new Exception("The parameter must be an integer");
    }

    public static function deleteOrder($id){
        if(is_int($id)){
            try{
                $order = Order::findOrFail($id);
                Order::destroy($id);

                return true;
            }
            catch(ModelNotFoundException $e){
                return false;
            }
        }

        throw new Exception("The parameter must be an integer");
    }

    public static function createOrder($order){
        // if($order instanceof Order){
        //     try{
        //         Order::findOrFail($order->id);
        //         return false;
        //     }
        //     catch(ModelNotFoundException $e){
        //         $order->created_at = now();
        //         $order->updated_at = now();
        //         $order_in_db = Order::create();
        //         $order_in_db->
                
        //         foreach($order->orderlines as $orderline)
        //         {
        //             OrderLine::createOrderLine($orderline);
        //         }

        //         $order->save();
        //         return true;
        //     }
        // }

        throw new Exception("The parameter must be of type Order");
    }

    public static function listOrdersByRestaurant($restaurant, $ascending){
        if($restaurant instanceof Restaurant && is_bool($ascending)){
            if($ascending == true){
                return $restaurant->orders()->getQuery()->orderBy('created_at', 'asc')->get();
            }
            return $restaurant->orders()->getQuery()->orderBy('created_at', 'desc')->get();
        }

        throw new Exception("The parameter must be of type Restaurant");
    }

    public static function listOrdersByUser($user, $ascending){
        if($user instanceof User && is_bool($ascending)){
            if($ascending == true){
                return $user->orders()->getQuery()->orderBy('created_at', 'asc')->get();
            }
            return $user->orders()->getQuery()->orderBy('created_at', 'desc')->get();
        }

        throw new Exception("The parameter must be of type User");
    }

    public function addOrderLine($orderline){
        if($orderline instanceof OrderLine){
            try{                                   
                $orderlines = $this->attributes['orderlines'];

                $exists = false;
                foreach($this->attributes['orderlines'] as $key => $value)               
                {
                    if($value->food->id == $orderline->food->id)
                    {                                                
                        $value->total_price += $value->food->price;
                        $value->quantity += 1;
                        $exists = true;
                        break;
                    }
                }

                if(!$exists)
                {   
                    $this->attributes['orderlines']->push($orderline);
                }

                $this->total_price += $orderline->total_price;
                return true;
            }
            catch(ModelNotFoundException $e){
                return false;
            }
        }
        throw new Exception("The parameter must be of type OrderLine");
    }

    public function removeOrderLine($orderline){
        if($orderline instanceof OrderLine){
            try{
                $orderlines = $this->attributes['orderlines'];
                foreach($this->attributes['orderlines'] as $key => $value)               
                {
                    if($value->food->id == $orderline->food->id)
                    {                        
                        $this->total_price -= $value->food->price;
                        $value->total_price -= $value->food->price;
                        
                        if($value->quantity == 1) 
                        {
                            $orderlines->forget($key);                        
                        }
                        else
                        {
                            $value->quantity -= 1;
                        }

                        break;
                    }
                }

                return true;
            }
            catch(ModelNotFoundException $e){
                return false;
            }
        }
        throw new Exception("The parameter must be an integer");
    }
}
