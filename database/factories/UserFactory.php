<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Role;
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

$factory->defineAs(User::class, 'AdminRestaurant', function (Faker $faker) {
    return [        
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => 'factoryuserpassword',        
        'remember_token' => Str::random(10),
        'role_id' => factory(Role::class, 'AdminRestaurant')->create()->id,        
    ];
});

$factory->defineAs(User::class, 'AdminApp', function (Faker $faker) {
    return [        
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => 'factoryuserpassword',        
        'remember_token' => Str::random(10),
        'role_id' => factory(Role::class, 'AdminApp')->create()->id,        
    ];
});

$factory->defineAs(User::class, 'Client', function (Faker $faker) {
    return [        
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => 'factoryuserpassword',        
        'remember_token' => Str::random(10),
        'role_id' => factory(Role::class, 'Client')->create()->id,        
    ];
});