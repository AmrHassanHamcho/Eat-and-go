<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illiminate\Database\Eloquent\ModelNotFoundException;
use Exception;

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
        return $this->hasMany('App\Food');
    }

    public function readRestaurant($id)
    {        
        if(is_int($id))
        {
            try
            {
                $restaurant = Restaurant::findOrFail($id);
                $this->id = $restaurant->id;
                $this->name = $restaurant->name;
                $this->address = $restaurant->address;
                $this->bank_account = $restaurant->bank_account;
                $this->phone = $restaurant->phone;
                $this->number_reviews = $restaurant->number_reviews;
                $this->image_url = $restaurant->image_url;

                $this->admin = $restaurant->admin;
                $this->reviews = $restaurant->reviews;
                $this->orders = $restaurant->orders;
                $this->foods = $restaurant->foods;

                return true;
            }
            catch(Exception $e)
            {
                return false;
            }
        }
        
        throw new Exception("The parameter must be an integer.");
    }

    public function updateRestaurant()
    {                   
        try
        {
            $restaurant = Restaurant::findOrFail($this->id);
            
            #$restaurant->admin()->associate($restaurant->admin);
            
            $this->save();
            return true;
        }
        catch(Excepcion $e)
        {
            return false;
        }
    }

    public function deleteRestaurant($id)
    {
        if(is_int($id))
        {
            try
            {
                $restaurant = Restaurant::findOrFail($id);
                Restaurant::destroy($id);

                return true;
            }
            catch(Exception $e)
            {
                return false;
            }
        }
        
        throw new Exception("The parameter must be an integer.");   
    }

    public function createRestaurant($restaurant)
    {
        if($restaurant instanceof Restaurant)
        {
            try
            {
                Restaurant::findOrFail($restaurant->id);                
                return false;
            }       
            catch(Exception $e)     
            {
                $restaurant->created_at = DateTime::getTimestamp();
                $restaurant->save();
                return true;
            }            
        }

        throw new Exception("The parameter must be of type Restaurant.");   
    }

}
