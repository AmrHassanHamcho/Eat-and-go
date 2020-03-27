<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Restaurant;
use App\User;
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
        'name' => 'FactoryRestaurant',
        'address' => 'FactoryRestaurantAddress',
        'bank_account' => 'FactoryRestaurantBankAccount',
        'phone' => 'FactoryRestaurantPhone',
        'admin_id' => factory(User::class, 'AdminRestaurant')->create()->id,
        'image_url' => 'FactoryRestaurant image url test',
        'number_reviews' => 0,
    ];
});