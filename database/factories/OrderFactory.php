<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Restaurant;
use App\Review;
use App\Order;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Order::class, function (Faker $faker) {
    return [        
        'total_price' => 50,
        'created_at' => now(),
        'updated_at' => now(),
        'user_id' => factory(User::class, 'Client')->create()->id,        
        'restaurant_id' => factory(Restaurant::class)->create()->id,        
    ];
});