<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
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
                $this->food = $order->food;
                $this->order = $order->order;
                $this->quantity = $order->quantity;
                $this->total_price = $order->total_price;

                return true;
            }
            catch(Exception $e){
                return false;
            }
        }
        
        throw new Exception("The parameter must be an integer");
    }

    public function deleteOrderLine($id){
        if(is_int($id)){
            try{
                $orderLine = OrderLine::findOrFind($id);
                OrderLine::destroy($id);

                return true;
            }
            catch(Exception $e){
                return false;
            }
        }

        throw new Exception("The parameter must be an integer");
    }

    public function createOrderLine($orderLine){
        if($orderLine instanceof OrderLine){
            try{
                OrderLine::findOrFail($orderLine->id);
                return false;
            }
            catch(Exception $e){
                $orderLine->created_at = DateTime::getTimestamp();
                $orderLine->save();
                return true;
            }

        }
    }



}
