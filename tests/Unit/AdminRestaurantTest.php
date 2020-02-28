<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\AdminRestaurant;
use App\Restaurant;

class AdminRestaurantTest extends TestCase
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
    public function admin_has_restaurant()
    {        
        $admin = AdminRestaurant::find(1);
        $restaurant = Restaurant::find(1);  

        $this->assertTrue($admin->restaurants->contains($restaurant));
    }
}
