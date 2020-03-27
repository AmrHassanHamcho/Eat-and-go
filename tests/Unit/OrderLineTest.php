<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Food;
use App\Order;
use App\OrderLine;

class OrderLineTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */ 
    public function orderLine_has_order()
    {        
        $orderline = OrderLine::find(1);                
        $order = $orderline->order;

        $this->assertInstanceOf(Order::class, $order);     
        $this->assertTrue($order->orderlines->contains($orderline));
    }

    /** @test */ 
    public function orderLines_has_food()
    {             
        $orderline = OrderLine::find(1);
        $food = $orderline->food;

        $this->assertInstanceOf(Food::class, $food);   
        $this->assertTrue($food->orderlines->contains($orderline));
    }  
}
