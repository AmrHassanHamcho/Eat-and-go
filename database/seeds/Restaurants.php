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
        DB::tabel('restaurants')->insert([
            'name'=> 'Testname',
            'address'=>'Testaddress',
            'bankaccount'=>'Testbankaccount',
            'phone'=>'123456789'
        ]);
    }
}
