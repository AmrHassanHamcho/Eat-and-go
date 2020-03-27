<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'price', 'restaurant_id',
    ];   

    public function restaurant(){
        return $this->belongsTo('App\Restaurant');
    }

    public function orderLines(){
        return $this->hasMany('App\OrderLine');
    }
}
