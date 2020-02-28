<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\AdminRestaurant;
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

$factory->define(AdminRestaurant::class, function (Faker $faker) {
    return [
        'id' => $faker->randomNumber,
        'name' => 'TestName_',
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'age' => 21,
        'phone' => 'TestPhone'
    ];
});