<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Client;
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
    //     $response = $this->get('/clients');

    //     $response->assertStatus(200);
    // }

    /** @test */ 
    public function review_has_client()
    {
        $client = Client::find(1);
        $restaurant = Restaurant::find(1);        
        $review = Review::where(['client_id' => $client->id, 'restaurant_id' => $restaurant->id])->get()[0];

        $this->assertInstanceOf(Review::class, $review);
        $this->assertEquals($client->id, $review->client->id);
    }

    public function review_has_restaurant()
    {
        $client = Client::find(1);
        $restaurant = Restaurant::find(1);        
        $review = Review::where(['client_id' => $client->id, 'restaurant_id' => $restaurant->id])->get()[0];

        $this->assertInstanceOf(Restaurant::class, $review->restaurant);
        $this->assertEquals($restaurant->id, $review->restaurant->id);
    }
}
