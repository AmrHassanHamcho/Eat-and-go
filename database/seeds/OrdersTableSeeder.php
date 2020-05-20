<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create(app\Order);
        
        DB::table('orders')->delete();

        for($i = 1; $i <= 10; $i++){
            DB::table('orders')->insert([
                'id'=>$i,
                'user_id'=> $faker->numberBetween(1,10),
                'restaurant_id'=>$faker->numberBetween(1,10),
                'total_price'=>$faker->numberBetween(5,1000),
                'address'=> $faker->address,
            ]);
        }
        
    }
}
