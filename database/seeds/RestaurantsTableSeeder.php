<?php

use Illuminate\Database\Seeder;

class RestaurantsTableSeeder extends Seeder
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
            'bank_account'=>'Testbankaccount',
            'phone'=>'123456789',
            'admin_id'=>2,
            'number_reviews'=>1,
            'image_url'=>'noImage',
        ]);
    }
}
