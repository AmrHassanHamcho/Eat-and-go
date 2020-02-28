<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Restaurant;
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

$factory->define(Restaurant::class, function (Faker $faker) {
    return [
        'id' => $faker->randomNumber,
        'name' => 'TestRestaurant_',
        'address' => 'TestAddress_',
        'bankAccount' => 'TestBankAccount_',
        'phone' => 'TestPhone_',
        'admin_restaurant_id' => $faker->randomNumber
    ];
});