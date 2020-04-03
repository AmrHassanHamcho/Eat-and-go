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
            'user_id'=>5,
            'restaurant_id'=>1,
            'title'=> 'Amazing',
            'comment'=> 'This is the best food i have ever tasted. I wish everyone could eat here everyday.',
            'score'=>5
        ]);

        DB::table('reviews')->insert([
            'id'=>2,
            'user_id'=>6,
            'restaurant_id'=>1,
            'title'=> 'Omg, i found hair in my food',
            'comment'=> 'Never eat here, the food was full of hair and i couldnt taste my food, aaagg',
            'score'=>1
        ]);

        DB::table('reviews')->insert([
            'id'=>3,
            'user_id'=>7,
            'restaurant_id'=>1,
            'title'=> 'Not bad',
            'comment'=> 'Not bad, but i expected better quality by that price. Not recommended',
            'score'=>3
        ]);

        DB::table('reviews')->insert([
            'id'=>4,
            'user_id'=>8,
            'restaurant_id'=>1,
            'title'=> 'It is good, but nothing special',
            'comment'=> 'One of the best restaurants in Springfield but in general, it is a bit bad in comparison to other restaurants ive been.',
            'score'=>4
        ]);

        DB::table('reviews')->insert([
            'id'=>5,
            'user_id'=>5,
            'restaurant_id'=>2,
            'title'=> 'Amazing',
            'comment'=> 'This is the best food i have ever tasted. I wish everyone could eat here everyday.',
            'score'=>5
        ]);

        DB::table('reviews')->insert([
            'id'=>6,
            'user_id'=>6,
            'restaurant_id'=>2,
            'title'=> 'Omg, i found hair in my food',
            'comment'=> 'Never eat here, the food was full of hair and i couldnt taste my food, aaagg',
            'score'=>1
        ]);

        DB::table('reviews')->insert([
            'id'=>7,
            'user_id'=>7,
            'restaurant_id'=>2,
            'title'=> 'Not bad',
            'comment'=> 'Not bad, but i expected better quality by that price. Not recommended',
            'score'=>3
        ]);

        DB::table('reviews')->insert([
            'id'=>8,
            'user_id'=>8,
            'restaurant_id'=>2,
            'title'=> 'It is good, but nothing special',
            'comment'=> 'One of the best restaurants in Springfield but in general, it is a bit bad in comparison to other restaurants ive been.',
            'score'=>4
        ]);
    }
}
