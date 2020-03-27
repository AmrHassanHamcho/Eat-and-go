<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Restaurant;
use App\Review;

class ReviewTest extends TestCase
{
    // use RefreshDatabase;
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function testExample()
    // {
    //     $response = $this->get('/users');

    //     $response->assertStatus(200);
    // }  
    /** @test */ 
    public function review_has_user()
    {          
        $review = factory(Review::class)->create();        
        $user = $review->user;   
        
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($user, User::find($user->id));                 
    }

    /** @test */ 
    public function review_has_restaurant()
    {       
        $review = factory(Review::class)->create();
        $restaurant = $review->restaurant;        
       
        $this->assertInstanceOf(Restaurant::class, $restaurant);
        $this->assertEquals($restaurant, Restaurant::find($restaurant->id));
    }    
}
