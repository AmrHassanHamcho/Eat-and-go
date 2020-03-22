<?php

use Illuminate\Database\Seeder;

class OrderLinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orderlines')->delete();
        DB::table('orderlines')->insert([
            'id'=>1,
            'order_id'=>1,
            'food_id'=>1,
            'quantity'=>2,
            'total_price'=>20,
        ]);
        
        DB::table('orderlines')->insert([
            'id'=>2,
            'order_id'=>1,
            'food_id'=>2,
            'quantity'=>1,
            'total_price'=>9,
        ]);
    }
}
