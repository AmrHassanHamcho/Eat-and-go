<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
                $this->restaurant_id = $order->restaurant;
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
                $order = Order::findOrFind($id);
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
        if($order instanceof Order){
            try{
                Order::findOrFail($order->id);
                return false;
            }
            catch(ModelNotFoundException $e){
                $order->created_at = now();
                $order->updated_at = now();
                $order->save();
                return true;
            }
        }

        throw new Exception("The parameter must be of type Order");
    }

    public function listOrdersByRestaurant($restaurant, $ascending){
        if($restaurant instanceof Restaurant && is_bool($ascending)){
            if($ascending == true){
                return $restaurant->orders()->getQuery()->orderBy('created_at', 'asc')->get();
            }
            return $restaurant->orders()->getQuery()->orderBy('created_at', 'desc')->get();
        }

        throw new Exception("The parameter must be of type Restaurant");
    }

    public function listOrdersByUser($user, $ascending){
        if($user instanceof User && is_bool($ascending)){
            if($ascending == true){
                return $user->orders()->getQuery()->orderBy('created_at', 'asc')->get();
            }
            return $user->orders()->getQuery()->orderBy('created_at', 'desc')->get();
        }

        throw new Exception("The parameter must be of type User");
    }

    public function addOrderLine($orderLine){
        if($orderLine instanceof OrderLine){
            try{
                OrderLine::findOrFail($orderLine->id);
                $orderLine->order = $this->id;
                return true;
            }
            catch(ModelNotFoundException $e){
                return false;
            }
        }
        throw new Exception("The parameter must be of type OrderLine");
    }

    public function removeOrderLine($id){
        if(is_int($lineId)){
            try{
                $orderLine = OrderLine::findOrFail($id);
                $orderLine->order = null;
                return true;
            }
            catch(ModelNotFoundException $e){
                return false;
            }
        }
        throw new Exception("The parameter must be an integer");
    }
}
