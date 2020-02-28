<?php

use Illuminate\Database\Seeder;

class AdminRestaurants extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_restaurants')->delete();
        DB::tabel('admin_restaurants')->insert([
            'name'=> 'Testname',
            'email'=>'Test@email.com',
            'password'=>'Testpassword',
            'phone'=>'123456789',
            'age'=>21
        ]);
    }
}
