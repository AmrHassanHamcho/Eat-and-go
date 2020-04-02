<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class OrderLine extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quantity', 'total_price', 'food_id', 'order_id'
    ];  

    public function food(){
        return $this->belongsTo('App\Food');
    }

    public function order(){
        return $this->belongsTo('App\Order');
    }


    public function readOrderLine($id){
        if(is_int($id)){
            try{
                $orderLine = OrderLine::findOrFail($id);
                $this->id = $order->id;
                $this->food_id = $order->food_id;
                $this->order_id = $order->order_id;
                $this->quantity = $order->quantity;
                $this->total_price = $order->total_price;

                return true;
            }
            catch(ModelNotFoundException $e){
                return false;
            }
        }
        
        throw new Exception("The parameter must be an integer");
    }

    public static function deleteOrderLine($id){
        if(is_int($id)){
            try{
                $orderLine = OrderLine::findOrFind($id);
                OrderLine::destroy($id);

                return true;
            }
            catch(ModelNotFoundException $e){
                return false;
            }
        }

        throw new Exception("The parameter must be an integer");
    }

    public static function createOrderLine($orderLine){
        if($orderLine instanceof OrderLine){
            try{
                OrderLine::findOrFail($orderLine->id);
                return false;
            }
            catch(ModelNotFoundException $e){
                $orderLine->created_at = now();
                $orderLine->updated_at = now();
                $orderLine->save();
                return true;
            }
        }

        throw new Exception("The parameter must be of type OrderLine");
    }



}
