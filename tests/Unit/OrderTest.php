<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Restaurant;
use App\Order;
use App\OrderLine;

class OrderTest extends TestCase
{
    use DatabaseTransactions;
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

    /** @test */ 
    public function order_has_restaurant()
    {       
        $order = Order::find(1);
        $restaurant = $order->restaurant;

        $this->assertInstanceOf(Restaurant::class, $restaurant);
        $this->assertEquals($restaurant, Restaurant::find($restaurant->id));
    } 

    /** @test */ 
    public function order_has_orderlines()
    {
        $order = Order::find(1);
        $orderlines = $order->orderlines;

        $this->assertInstanceOf(OrderLine::class, $orderlines[0]);
        $this->assertEquals($orderlines, OrderLine::where('order_id', $order->id)->get());
    }

    /** @test */ 
    public function readOrder_test1(){
        $expected = factory(Order::class)->create();

        $actual = new Order;
        $result = $actual->readOrder($expected->id);

        $this->assertTrue($result);
        $this->assertEquals($expected->user_id, $actual->user_id);
        $this->assertEquals($expected->restaurant_id, $actual->restaurant_id);
        $this->assertEquals($expected->total_price, $actual->total_price); 
    }

    /** @test */
    public function readOrder_test2(){
        $orderTest = new Order;
        $result = $orderTest->readOrder(99);

        $this->assertFalse($result);
    }

    /** @test */ 
    public function deleteOrder_test1()
    {
        $order = factory(Order::class)->create();

        $result = Order::deleteOrder($order->id);

        $this->assertTrue($result);
    }

    /** @test */ 
    public function deleteOrder_test2()
    {
        $order = new Order;
        $order->id = 99;
        $order->user_id = 1;
        $order->restaurant_id = 1;
        $order->total_price = 1;

        $result = Order::deleteOrder($order->id);
        $result2 = $order->readOrder($order->id);

        $this->assertFalse($result);        
        $this->assertFalse($result2);
    }

    /** @test */ 
    public function createOrder_test1()
    {
        $order = new Order;
        $order->id = 99;
        $order->user_id = 1;
        $order->restaurant_id = 1;
        $order->total_price = 1;

        $result = Order::createOrder($order);
        $result2 = $order->readOrder($order->id);

        $this->assertTrue($result);        
        $this->assertTrue($result2);
    }

    /** @test */
    public function listOrdersByRestaurant_test1(){
        $restaurant = $this->aux_restaurant();
        $orders = Order::listOrdersByRestaurant($restaurant, true);

        $order_last = $orders[0];
        foreach($orders as $order){
            $this->assertTrue($order_last->created_at <= $order->created_at);
            $order_last = clone $order;
        }

    }

    /** @test */
    public function listOrdersByRestaurant_test2(){
        $restaurant = $this->aux_restaurant();
        $orders = Order::listOrdersByRestaurant($restaurant, false);

        $order_last = $orders[0];
        foreach($orders as $order){
            $this->assertTrue($order_last->created_at >= $order->created_at);
            $order_last = clone $order;
        }
    }

    /** @test */
    public function listOrdersByUser_test1(){
        $user = $this->aux_user();
        $orders = Order::listOrdersByUser($user, true);

        $order_last = $orders[0];
        foreach($orders as $order){
            $this->assertTrue($order_last->created_at <= $order->created_at);
            $order_last = clone $order;
        }
    }

    /** @test */
    public function listOrdersByUser_test2(){
        $user = $this->aux_user();
        $orders = Order::listOrdersByUser($user, false);

        $order_last = $orders[0];
        foreach($orders as $order){
            $this->assertTrue($order_last->created_at >= $order->created_at);
            $order_last = clone $order;
        }
    }

    private function aux_restaurant(){
        $restaurant = factory(Restaurant::class)->create();

        $user = factory(User::class, 'Client')->create();
        $user->role_id = 3;

        $order1 = new Order;
        $order1->created_at = now();
        $order1->user_id = $user->id;
        $order1->restaurant_id = $restaurant->id;
        $order1->total_price = 22;
        

        $order1 = new Order;
        $order1->created_at = now();
        $order1->user_id = $user->id;
        $order1->restaurant_id = $restaurant->id;
        $order1->total_price = 22;

        Order::createOrder($order1);
        Order::createOrder($order2);

        return $restaurant;
    }

    private function aux_user(){
        $restaurant = factory(Restaurant::class)->create();

        $user = factory(User::class, 'Client')->create();
        $user->role_id = 3;

        $order1 = new Order;
        $order1->created_at = now();
        $order1->user_id = $user->id;
        $order1->restaurant_id = $restaurant->id;
        $order1->total_price = 22;

        $order2 = new Order;
        $order2->created_at = now();
        $order2->user_id = $user->id;
        $order1->restaurant_id = $restaurant->id;
        $order1->total_price = 22;

        Order::createOrder($order1);
        Order::createOrder($order2);

        return $user;
    }
}
