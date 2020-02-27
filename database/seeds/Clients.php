<?php

use Illuminate\Database\Seeder;

class Clients extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->delete();
        DB::tabel('clients')->insert([
            'name'=> 'Testname',
            'email'=>'Test@email.com',
            'password'=>'Testpassword',
            'phone'=>'123456789',
            'card'=>'Testcard',
            'age'=>21
        ]);
    }
}
