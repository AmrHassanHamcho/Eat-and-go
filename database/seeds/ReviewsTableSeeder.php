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
            'title'=> 'TestTitle3',
            'comment'=> '3 This is just a test reviews created for testing purposes. No sense, just filling spaces. I am hungry, are you?',
            'score'=>1
        ]);

        DB::table('reviews')->insert([
            'id'=>2,
            'user_id'=>2,
            'restaurant_id'=>1,
            'title'=> 'TestTitle2',
            'comment'=> '2 This is just a test reviews created for testing purposes. No sense, just filling spaces. I am hungry, are you?',
            'score'=>2
        ]);

        DB::table('reviews')->insert([
            'id'=>3,
            'user_id'=>1,
            'restaurant_id'=>1,
            'title'=> 'TestTitle1',
            'comment'=> '1 This is just a test reviews created for testing purposes. No sense, just filling spaces. I am hungry, are you?',
            'score'=>3
        ]);
    }
}
