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

class RoleTest extends TestCase
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
    public function role_has_user()
    {
        $role = Role::find(1);
        $users = $role->users;

        $this->assertInstanceOf(User::class, $users[0]);
        $this->assertEquals($users, User::where('role_id', $role->id)->get());
    }
}
