<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
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

$factory->defineAs(Role::class, 'AdminApp', function (Faker $faker) {
    return [             
        'name'=> 'AdminAppFactory',            
        'description'=>'The users with this role assigned can access any functionality of the application.',                                                
    ];
});

$factory->defineAs(Role::class, 'AdminRestaurant', function (Faker $faker) {
    return [                
        'name'=> 'AdminRestaurantFactory',            
        'description'=>'The users with this role assigned can modify all the data of the restaurant they have assigned.',                                            
    ];
});

$factory->defineAs(Role::class, 'Client', function (Faker $faker) {
    return [            
        'name'=> 'ClientFactory',            
        'description'=>'The users with this role assigned can only access the basic operationf of a common user (buying, look at restaurants...).',                                                              
    ];
});