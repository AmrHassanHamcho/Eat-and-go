<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Restaurant;
use App\Order;
use App\OrderLine;

class OrderTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */ 
    public function order_has_user()
    {
        $order = Order::find(1);
        $user = $order->user;
        
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($user, User::find($user->id));        
    }

    public function order_has_restaurant()
    {       
        $order = Order::find(1);
        $restaurant = $order->restaurant;

        $this->assertInstanceOf(Restaurant::class, $restaurant);
        $this->assertEquals($restaurant, User::find($restaurant->id));
    } 

    public function order_has_orderlines()
    {
        $order = Order::find(1);
        $orderlines = $order->orderlines;

        $this->assertInstanceOf(OrderLine::class, $orderlines[0]);
        $this->assertEquals($orderlines, OrderLines::where('order_id', $order->id)->get());
    }
}
