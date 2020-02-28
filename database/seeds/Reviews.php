<?php

use Illuminate\Database\Seeder;

class Reviews extends Seeder
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
            'client_id'=>1,
            'restaurant_id'=>1,
            'comment'=> 'Testcomment',
            'score'=>5.0
        ]);
    }
}
