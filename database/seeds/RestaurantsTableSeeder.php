<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create(app\Restaurant);
        

        DB::table('restaurants')->delete();

        for($i = 1; $i <50; $i++){
            DB::table('restaurants')->insert([
                'id'=>$i,
                'name'=> $faker->name,
                'address'=>$faker->address,
                'bank_account'=>$faker->bankAccountNumber,
                'phone'=>$faker->phoneNumber,
                'admin_id'=>$i,
                'number_reviews'=>$faker->numberBetween(1,100),
                'image_url'=>$faker->imageUrl($width = 640, $height = 320),
            ]);
    

        }
        /*
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
        */
    }
}
