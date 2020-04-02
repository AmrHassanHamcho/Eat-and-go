<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

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

    public function readFood($id)
    {        
        if(is_int($id))
        {
            try
            {                
                $food = Food::findOrFail($id);
                $this->attributes = $food->attrbutes;                

                return true;
            }
            catch(ModelNotFoundException $e)
            {
                return false;
            }
        }
        
        throw new Exception("The parameter must be an integer.");        
    }

    public function updateFood()
    {                   
        try
        {
            $food = Food::findOrFail($this->id);
            $food->updated_at = now();
            $this->save();
            return true;
        }
        catch(ModelNotFoundException $e)
        {
            return false;
        }
    }

    public static function deleteFood($id)
    {
        if(is_int($id))
        {
            try
            {
                $food = Food::findOrFail($id);
                Food::destroy($id);

                return true;
            }
            catch(ModelNotFoundException $e)
            {
                return false;
            }
        }
        
        throw new Exception("The parameter must be an integer.");   
    }

    public static function createFood($food)
    {
        if($food instanceof Food)
        {
            try
            {
                Food::findOrFail($food->id);                
                return false;
            }       
            catch(ModelNotFoundException $e)     
            {
                $food->created_at = now();
                $food->updated_at = now();
                Food::create($food->attributes);                
                
                return true;
            }            
        }

        throw new Exception("The parameter must be of type Food.");   
    }

}
