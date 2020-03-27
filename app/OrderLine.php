<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
