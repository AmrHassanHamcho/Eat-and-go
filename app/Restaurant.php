<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    public function admin(){
        return $this->belongsTo('App\AdminRestaurant');
    }
}
