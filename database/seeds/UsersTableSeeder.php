<?php

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert([
            'id'=>1,
            'name'=> 'admin1',
            'email'=>'admin1@gmail.com',
            'password'=>\bcrypt('admin'),            
            'role_id'=>2 // AdminRestaurant
        ]);

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
    }
}