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
            'name'=> 'Tony El Gordo restaurant',
            'address'=>'742 Evergreen Terrace in Springfield',
            'bank_account'=>'123456789',
            'phone'=>'666 111 222',
            'admin_id'=>1,
            'number_reviews'=>4,
            'image_url'=>'/img/tonielgordo.jpeg',
        ]);

        DB::table('restaurants')->insert([
            'id'=>2,
            'name'=> 'Dragon Chinese',
            'address'=>'Avenida de las Habaneras, 78, Torrevieja, 03182',
            'bank_account'=>'123456789',
            'phone'=>'666 333 444',
            'admin_id'=>2,
            'number_reviews'=>4,
            'image_url'=>'/img/dragonchinese.jpeg',
        ]);

        DB::table('restaurants')->insert([
            'id'=>3,
            'name'=> 'Boris Restaurant',
            'address'=>'Interchange, 2nd floor',
            'bank_account'=>'123456789',
            'phone'=>'666 555 666',
            'admin_id'=>3,
            'number_reviews'=>0,
            'image_url'=>'/img/borisrestaurant.png',
        ]);
    }
}
