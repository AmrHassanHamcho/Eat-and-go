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
        DB::tabel('reviews')->insert([
            'comment'=> 'Testcomment',
            'score'=>5.0
        ]);
    }
}
