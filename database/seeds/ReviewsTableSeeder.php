<?php

use Illuminate\Database\Seeder;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reviews')->delete();
        DB::table('reviews')->insert([
            'id'=>1,
            'user_id'=>3,
            'restaurant_id'=>1,
            'comment'=> 'Testcomment',
            'score'=>5.0
        ]);
    }
}
