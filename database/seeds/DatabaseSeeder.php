<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {        
        $this->call(RolesTableSeeder::class);
        $this->command->info('roles table seeded!');

        $this->call(UsersTableSeeder::class);
        $this->command->info('users table seeded!');

        $this->call(RestaurantsTableSeeder::class);
        $this->command->info('restaurants table seeded!');

        $this->call(ReviewsTableSeeder::class);
        $this->command->info('reviews table seeded!');

        $this->call(FoodsTableSeeder::class);
        $this->command->info('foods table seeded!');

        $this->call(OrdersTableSeeder::class);
        $this->command->info('orders table seeded!');

        $this->call(OrderLinesTableSeeder::class);
        $this->command->info('orderlines table seeded!');

    }
}