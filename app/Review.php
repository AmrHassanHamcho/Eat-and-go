<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class Review extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'score', 'comment', 'user_id', 'restaurant_id',
    ];    

    // public function __construct1()
    // {
    //     print("\n CONSTRUCTOR 1 \n");
    //     $this->comment = null;
    //     $this->score = 0;
    //     $this->user = null;
    //     $this->restaurant = null;
    // }

    // public function __construct($comment, $score, $user, $restaurant)
    // {
    //     print("\n CONSTRUCTOR 2 \n");
    //     $this->comment = $comment;
    //     $this->score = $score;
    //     $this->user = $user;
    //     $this->restaurant = $restaurant;
    // }

    public function readReview($id)
    {        
        if(is_int($id))
        {
            try
            {                
                $review = Review::findOrFail($id);
                $this->id = $review->id;
                $this->comment = $review->comment;
                $this->score = $review->score;
                $this->user_id = $review->user_id;
                $this->restaurant_id = $review->restaurant_id;
                $this->created_at = $review->created_at;
                $this->updated_at = $review->updated_at;

                return true;
            }
            catch(ModelNotFoundException $e)
            {
                return false;
            }
        }
        
        throw new Exception("The parameter must be an integer.");        
    }

    public function updateReview()
    {                   
        try
        {
            $review = Review::findOrFail($this->id);
            $review->updated_at = now();
            $this->save();
            return true;
        }
        catch(ModelNotFoundException $e)
        {
            return false;
        }
    }

    public function deleteReview($id)
    {
        if(is_int($id))
        {
            try
            {
                $review = Review::findOrFail($id);
                $restaurant = $review->restaurant;
                $restaurant->number_reviews -= 1;
                $restaurant->save();

                Review::destroy($id);

                return true;
            }
            catch(ModelNotFoundException $e)
            {
                return false;
            }
        }
        
        throw new Exception("The parameter must be an integer.");   
    }

    public function createReview($review)
    {
        if($review instanceof Review)
        {
            try
            {
                Review::findOrFail($review->id);                
                return false;
            }       
            catch(ModelNotFoundException $e)     
            {
                $review->created_at = now();
                $review->updated_at = now();

                $restaurant = $review->restaurant;
                $restaurant->number_reviews += 1;

                $restaurant->save();
                $review->save();
                
                return true;
            }            
        }

        throw new Exception("The parameter must be of type Review.");   
    }

    public function listReviewsByDate($restaurant)
    {
        if($restaurant instanceof Restaurant)
        {
            return $restaurant->reviews()->getQuery()->orderBy('created_at', 'desc')->get();
        }

        throw new Exception("The parameter must be of type Review.");   
    }

    public function listReviewsByScore($restaurant)
    {
        if($restaurant instanceof Restaurant)
        {
            return $restaurant->reviews()->getQuery()->orderBy('score', 'desc')->get();
        }

        throw new Exception("The parameter must be of type Review.");   
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function restaurant(){
        return $this->belongsTo('App\Restaurant');
    }
}
