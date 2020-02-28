<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Review;
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

$factory->define(Review::class, function (Faker $faker) {
    return [
        'client_id' => $faker->randomNumber,
        'restaurant_id' => $faker->randomNumber,
        'comment' => 'TestComment_', //+ $faker->restaurant_id + '_' + $faker->client_id,
        'score' => 9.5,
    ];
});