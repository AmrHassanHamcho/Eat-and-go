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
        DB::table('order_lines')->delete();
        DB::table('order_lines')->insert([
            'id'=>1,
            'order_id'=>1,
            'food_id'=>1,
            'quantity'=>2,
            'total_price'=>20,
        ]);
        
        DB::table('order_lines')->insert([
            'id'=>2,
            'order_id'=>1,
            'food_id'=>2,
            'quantity'=>1,
            'total_price'=>9,
        ]);
    }
}
