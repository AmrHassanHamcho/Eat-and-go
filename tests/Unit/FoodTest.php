<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Food;
use App\Restaurant;
use App\OrderLine;

class FoodTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */ 
    public function food_has_restaurant()
    {        
        $food = Food::find(1);                
        $restaurant = $food->restaurant;
            
        $this->assertInstanceOf(Restaurant::class, $restaurant);
        $this->assertTrue($restaurant->foods->contains($food));        
    }

    public function food_has_orderlines()
    {        
        $food = Food::find(1);                
        $orderlines = $food->orderlines;
        
        $this->assertInstanceOf(OrderLine::class, $orderlines[0]);   
        $this->assertTrue($food->orderlines->contains($orderline));
    }  
}
