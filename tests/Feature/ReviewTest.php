<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReviewTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */ 
    public function client_review_of_restaurant()
    {
        $client = factory(Client::class)->create();
        $restaurant = factory(Restaurant::class)->create();
        $review = factory(Review::class)->create(['client_id' => $client->id, 'restaurant_id' => $restaurant->id]);

        $this->assertInstanceOf(Review::class, $review);
    }
}

}
