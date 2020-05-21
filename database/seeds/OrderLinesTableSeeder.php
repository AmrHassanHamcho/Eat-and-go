<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class OrderLinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        DB::table('order_lines')->delete();

        for($i = 1;$i <= 50;$i++)
        {
            $faker = Faker::create(OrderLine::class);
            DB::table('order_lines')->insert([
                // 'id'=>$i,
                'order_id'=>$faker->numberBetween(1,10),
                'food_id'=>$faker->numberBetween(1,10),
                'quantity'=>$faker->numberBetween(1,20),
                'total_price'=>$faker->numberBetween(5,500),
            ]);
        }
        /*
        DB::table('order_lines')->insert([
            'id'=>2,
            'order_id'=>1,
            'food_id'=>2,
            'quantity'=>1,
            'total_price'=>9,
        ]);
        */
    }
}
