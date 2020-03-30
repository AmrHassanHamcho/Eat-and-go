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
            'image_url'=>'/img/justeat.png',
        ]);

        DB::table('restaurants')->insert([
            'id'=>2,
            'name'=> 'BTestname2',
            'address'=>'Testaddress2',
            'bank_account'=>'Testbankaccount2',
            'phone'=>'123456789',
            'admin_id'=>2,
            'number_reviews'=>3,
            'image_url'=>'/img/justeat.png',
        ]);

        DB::table('restaurants')->insert([
            'id'=>3,
            'name'=> 'ATestname3',
            'address'=>'Testaddress3',
            'bank_account'=>'Testbankaccount3',
            'phone'=>'123456789',
            'admin_id'=>2,
            'number_reviews'=>2,
            'image_url'=>'/img/justeat.png',
        ]);
    }
}
