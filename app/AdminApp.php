<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminApp extends Model
{
    public function user(){
        return $this->morphOne('App\User', 'enrolled');
    }  
}
