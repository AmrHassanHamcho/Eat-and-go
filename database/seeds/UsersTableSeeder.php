<?php

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use app\User;
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
        $faker = Faker::create(app\User);
        
        for($i = 1; $i <= 10; $i++){
        
        DB::table('users')->delete();
        DB::table('users')->insert([
            'id'=>$i,
            'name'=> $faker->name,
            'email'=>$faker->unique()->safeEmail,
            'password'=>\bcrypt('admin'),            
            'role_id'=>2 // AdminRestaurant
        ]);
        }

        for($i = 10; $i <= 20; $i++){
        
            DB::table('users')->delete();
            DB::table('users')->insert([
                'id'=>$i,
                'name'=> $faker->name,
                'email'=>$faker->unique()->safeEmail,
                'password'=>\bcrypt('superadmin'),            
                'role_id'=>1 //AdminApp
            ]);
            }

            for($i = 20; $i <= 30; $i++){
        
                DB::table('users')->delete();
                DB::table('users')->insert([
                    'id'=>$i,
                    'name'=> $faker->name,
                    'email'=>$faker->unique()->safeEmail,
                    'password'=>\bcrypt('client'),            
                    'role_id'=>3 // Client
                ]);
                }

        /*
        DB::table('users')->insert([
            'id'=>2,
            'name'=> 'admin2',
            'email'=>'admin2@email.com',
            'password'=>\bcrypt('admin'),            
            'role_id'=>2 // AdminRestaurant
        ]);

        DB::table('users')->insert([
            'id'=>3,
            'name'=> 'admin3',
            'email'=>'admin3@email.com',
            'password'=>\bcrypt('admin'),            
            'role_id'=>2 // AdminRestaurant
        ]);        

        DB::table('users')->insert([
            'id'=>4,
            'name'=> 'superadmin',
            'email'=>'superadmin@gmail.com',
            'password'=>\bcrypt('superadmin'),            
            'role_id'=>1 // AdminApp
        ]);

        DB::table('users')->insert([
            'id'=>5,
            'name'=> 'Juan Ramón',
            'email'=>'juanramon@gmail.com',
            'password'=>\bcrypt('client'),            
            'role_id'=>3 // Client
        ]);

        DB::table('users')->insert([
            'id'=>6,
            'name'=> 'Francisco Calvo',
            'email'=>'franciscocalvo@gmail.com',
            'password'=>\bcrypt('client'),            
            'role_id'=>3 // Client
        ]);

        DB::table('users')->insert([
            'id'=>7,
            'name'=> 'Enrique Fernando',
            'email'=>'enriquefernando@gmail.com',
            'password'=>\bcrypt('client'),            
            'role_id'=>3 // Client
        ]);

        DB::table('users')->insert([
            'id'=>8,
            'name'=> 'Roberto Carlos',
            'email'=>'roberlocarlos@gmail.com',
            'password'=>\bcrypt('client'),            
            'role_id'=>3 // Client
        ]);
/*
        $p9 = new User;
        $p9->name="test";
        $p9->email="test@gmail.com";
        $p9->password="1234";
        $p9->role_id=3;
        $p9->save();
*/

    }
}