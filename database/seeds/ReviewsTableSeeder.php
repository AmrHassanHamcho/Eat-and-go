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
            'title'=> 'TestTitle',
            'comment'=> 'This is just a test reviews created for testing purposes. No sense, just filling spaces. I am hungry, are you?',
            'score'=>5
        ]);
    }
}
