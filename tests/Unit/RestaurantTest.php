<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Role;
use App\Restaurant;
use App\Review;
use App\Order;
use App\User;

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
        $restaurant = Restaurant::find(1);
        $reviews = $restaurant->reviews;

        $this->assertInstanceOf(Review::class, $reviews[0]);
        $this->assertEquals($reviews, Review::where('restaurant_id', '=', $restaurant->id)->get());
    }

    public function restaurant_has_orders()
    {
        $restaurant = Restaurant::find(1);
        $orders = $restaurant->orders;

        $this->assertInstanceOf(Order::class, $orders[0]);
        $this->assertEquals($orders, Order::where('restaurant_id', $restaurant->id)->get());
    }

    /** @test */ 
    public function restaurant_has_admin()
    {        
        $restaurant = Restaurant::find(1);
        $admin = $restaurant->admin;
        $role = Role::where('name', 'AdminRestaurant')->get()[0];

        $this->assertInstanceOf(User::class, $restaurant->admin);
        $this->assertInstanceOf(Role::class, $admin->role);

        $this->assertEquals($admin->id, $restaurant->admin->id);
        $this->assertEquals($admin->role->id, $role->id);
    }
}
