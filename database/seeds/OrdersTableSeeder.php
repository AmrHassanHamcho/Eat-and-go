<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->delete();
        DB::table('orders')->insert([
            'id'=>1,
            'user_id'=> 3,
            'restaurant_id'=>1,
            'total_price'=>9.5,
        ]);
    }
}
