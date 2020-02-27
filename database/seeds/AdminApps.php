<?php

use Illuminate\Database\Seeder;

class AdminApps extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_apps')->delete();
        DB::tabel('admin_apps')->insert([
            'name'=> 'Testname',
            'email'=>'Test@email.com',
            'password'=>'Testpassword',
            'phone'=>'123456789',
            'age'=>21

        ]);
    }
}
