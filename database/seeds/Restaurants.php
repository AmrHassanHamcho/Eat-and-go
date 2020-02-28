<?php

use Illuminate\Database\Seeder;

class Restaurants extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('restaurants')->delete();
        DB::table('restaurants')->insert([
            'id'=>1,
            'name'=> 'Testname',
            'address'=>'Testaddress',
            'bankaccount'=>'Testbankaccount',
            'phone'=>'123456789',
            'admin_restaurant_id'=>1
        ]);
    }
}
