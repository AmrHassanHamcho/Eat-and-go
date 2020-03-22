<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function restaurant(){
        return $this->belongsTo('App\Restaurant');
    }

    public function orderLines(){
        return $this->hasMany('App\OrderLine');
    }
}
