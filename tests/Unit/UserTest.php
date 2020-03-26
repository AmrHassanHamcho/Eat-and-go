<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Restaurant;
use App\Review;
use App\Order;
use App\Role;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function testExample()
    // {
    //     $response = $this->get('/admin_restaurants');

    //     $response->assertStatus(200);
    // }

    /** @test */ 
    public function user_has_restaurant()
    {        
        $user = User::find(2);
        $restaurant = $user->restaurant; 

        $this->assertInstanceOf(Restaurant::class, $restaurant);
        $this->assertEquals($restaurant, Restaurant::find($restaurant->id));
    }

    /** @test */ 
    public function user_has_role()
    {
        $user = User::find(1);
        $role = $user->role;

        $this->assertInstanceOf(Role::class, $role);
        $this->assertEquals($role, $user->role);
    }

    /** @test */ 
    public function user_has_orders()
    {
        $user = User::find(3);
        $orders = $user->orders;

        $this->assertInstanceOf(Order::class, $orders[0]);
        $this->assertEquals($orders, Order::where('user_id', $user->id)->get());
    }

    /** @test */ 
    public function user_has_reviews()
    {
        $user = User::find(3);
        $reviews = $user->reviews;

        $this->assertInstanceOf(Review::class, $reviews[0]);
        $this->assertEquals($reviews, Review::where('user_id', $user->id)->get());
    }
}
