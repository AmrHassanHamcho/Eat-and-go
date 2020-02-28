<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Client;
use App\AdminRestaurant;
use App\Restaurant;
use App\Review;

class ClientTest extends TestCase
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
    public function client_has_reviews()
    {
        $client = Client::find(1);
        $restaurant = Restaurant::find(1);        
        $review = Review::where(['client_id' => $client->id, 'restaurant_id' => $restaurant->id])->get()[0];

        $this->assertInstanceOf(Review::class, $review);
        $this->assertTrue($client->reviews->contains($review));
    }
}
