<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Restaurant;
use App\Review;

class ReviewTest extends TestCase
{
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
        $review = Review::find(1);
        $user = $review->user;
        
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($user, User::find($user->id));        
    }

    public function review_has_restaurant()
    {       
        $review = Review::find(1);
        $restaurant = $review->restaurant;

        $this->assertInstanceOf(Restaurant::class, $restaurant);
        $this->assertEquals($restaurant, User::find($restaurant->id));
    }
}
