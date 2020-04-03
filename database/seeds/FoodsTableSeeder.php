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
            'name'=>'Ravioli di Boletus',
            'description'=>'The most delicious Ravioli di Boletus',
            'price'=>9.70,
        ]);

        DB::table('foods')->insert([
            'id'=>2,
            'restaurant_id'=>1,
            'name'=>'Pizza with pineapple extra-large',
            'description'=>'The pizza made for the lovers of pineapple',
            'price'=>7,
        ]);
        
        DB::table('foods')->insert([
            'id'=>3,
            'restaurant_id'=>2,
            'name'=>'Chinese roll with sweet and sour flavors',
            'description'=>'Typical chinese dish prepared by Wei He',
            'price'=>3.95,
        ]);

        DB::table('foods')->insert([
            'id'=>4,
            'restaurant_id'=>2,
            'name'=>'Dog with salad',
            'description'=>'Chinese dog prepared by our chinese uncle Wei He',
            'price'=>15,
        ]);
        
        DB::table('foods')->insert([
            'id'=>5,
            'restaurant_id'=>3,
            'name'=>'Borscht',
            'description'=>'Borscht is a beet soup that originated in the Ukraine and was quickly adopted as a Russian specialty as well',
            'price'=>14.95,
        ]);

        DB::table('foods')->insert([
            'id'=>6,
            'restaurant_id'=>3,
            'name'=>'Tushanka',
            'description'=>'Food found in Tarkov. Usually carried by Skavs',
            'price'=>11,
        ]);
    }
}
