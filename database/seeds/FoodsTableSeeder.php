<?php

use Illuminate\Database\Seeder;

class FoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('foods')->delete();
        DB::table('foods')->insert([
            'id'=>1,
            'restaurant_id'=>1,
            'name'=>'Hot dog',
            'description'=>'Really delicious hot dog.',
            'price'=>10,
        ]);

        DB::table('foods')->insert([
            'id'=>2,
            'restaurant_id'=>1,
            'name'=>'Pizza',
            'description'=>'Pizza with extra cheese and chicken.',
            'price'=>9,
        ]);
    }
}
