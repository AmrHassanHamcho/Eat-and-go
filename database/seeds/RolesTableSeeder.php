<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();
        DB::table('roles')->insert([
            'id'=>1,
            'name'=> 'AdminApp',            
            'description'=>'The users with this role assigned can access any functionality of the application.',                        
        ]);
        
        DB::table('roles')->insert([
            'id'=>2,
            'name'=> 'AdminRestaurant',            
            'description'=>'The users with this role assigned can modify all the data of the restaurant they have assigned.',                        
        ]);

        DB::table('roles')->insert([
            'id'=>3,
            'name'=> 'Client',            
            'description'=>'The users with this role assigned can only access the basic operationf of a common user (buying, look at restaurants...).',                        
        ]);
    }
}
