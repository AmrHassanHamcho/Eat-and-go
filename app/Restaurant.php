<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'address', 'bank_account', 'phone', 'number_reviews', 'image_url', 'admin_id',
    ];    

     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'bank_account', 'admin_id',
    ];

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
        return $this->hasMany('App\Food');
    }
}
