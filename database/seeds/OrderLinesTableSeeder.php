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
        $faker = Faker::create(app\OrderLine);
        DB::table('order_lines')->delete();

        for($i = 1;$i <= 50;$i++)
        DB::table('order_lines')->insert([
            'id'=>$i,
            'order_id'=>numberBetween(1,10),
            'food_id'=>numberBetween(1,10),
            'quantity'=>numberBetween(1,20),
            'total_price'=>numberBetween(5,500),
        ]);
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
