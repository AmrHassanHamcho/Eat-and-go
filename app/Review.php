<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function readReview($id)
    {        
        if(is_int($id))
        {
            try
            {
                $review = Review::findOrFail($id);
                $this->id = $review->id;
                $this->comment = $review->comment;
                $this->description = $review->description;
                $this->score = $review->score;
                $this->restaurant = $review->restaurant;
                $this->user = $review->user;

                return true;
            }
            catch(Exception $e)
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
            $this->save();
            return true;
        }
        catch(Excepcion $e)
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
                Review::destroy($id);

                return true;
            }
            catch(Exception $e)
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
            catch(Exception $e)     
            {
                $review->created_at = DateTime::getTimestamp();
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
