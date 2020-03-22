<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    public function admin(){
        return $this->belongsTo('App\User', 'admin_id');
    }

    public function reviews(){
        return $this->hasMany('App\Review');
    }

    public function orders(){
        return $this->hasMany('App\Order');
    }

    public function foods(){
        return $this->hasMany('App\Order');
    }
}
