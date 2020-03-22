<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\AdminRestaurant;
use App\Restaurant;
use App\Review;
use App\Client;

class RestaurantTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function testExample()
    // {
    //     $response = $this->get('/restaurants');

    //     $response->assertStatus(200);
    // }

    /** @test */ 
    public function restaurant_has_reviews()
    {
        // $client = factory(Client::class)->create();
        // $restaurant = factory(Restaurant::class)->create();
        // $review = factory(Review::class)->create(['client_id' => $client->id, 'restaurant_id' => $restaurant->id]);

        $client = User::find(1);
        $restaurant = Restaurant::find(1);
        $review = Review::where(['user_id' => $client->id, 'restaurant_id' => $restaurant->id])->get()[0];

        $this->assertTrue($restaurant->reviews->contains($review));
    }

    /** @test */ 
    public function restaurant_has_admin()
    {
        $admin = User::find(2);
        $restaurant = Restaurant::find(1);
        $role = Role::where('name', 'AdminRestaurant')->get()[0];

        $this->assertInstanceOf(User::class, $restaurant->admin);
        $this->assertEquals($admin->id, $restaurant->admin->id);
        $this->assertEquals($admin->role(), $role->id);
    }
}
