<?php

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create(User::class);
        DB::table('users')->delete();
        
        DB::table('users')->insert([            
            'name'=> 'superadmin',
            'email'=>'superadmin@gmail.com',
            'password'=>\bcrypt('admin'),            
            'role_id'=>1 // AdminApp
        ]);

        for($i = 1; $i <= 10; $i++){                        
            DB::table('users')->insert([            
                'name'=> "admin".$i,
                'email'=>"admin".$i."@gmail.com",
                'password'=>\bcrypt('admin'),            
                'role_id'=>2 // AdminRestaurant
            ]);
        }

        for($i = 1; $i <= 10; $i++){
            DB::table('users')->insert([                
                'name'=> $faker->unique()->name,
                'email'=>$faker->unique()->safeEmail,
                'password'=>\bcrypt('client'),            
                'role_id'=>3 // Client
            ]);
        }                
    }
}