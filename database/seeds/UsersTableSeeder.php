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
            'name'=> 'admin',
            'email'=>'admin@gmail.com',
            'password'=>\bcrypt('admin'),            
            'role_id'=>1 // AdminApp
        ]);

        DB::table('users')->insert([
            'id'=>2,
            'name'=> 'Testname2',
            'email'=>'test2@email.com',
            'password'=>\bcrypt('Testpassword2'),            
            'role_id'=>2 // AdminRestaurant
        ]);

        DB::table('users')->insert([
            'id'=>3,
            'name'=> 'Testname3',
            'email'=>'test3@email.com',
            'password'=>\bcrypt('Testpassword3'),            
            'role_id'=>3 // Client
        ]);
    }
}