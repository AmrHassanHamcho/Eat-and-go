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
        $this->call(AdminApps::class);
        $this->command->info('admin_apps table seeded!');
        $this->call(AdminRestaurants::class);
        $this->command->info('admin_restaurants table seeded!');
        $this->call(Clients::class);
        $this->command->info('clients table seeded!');
        $this->call(Restaurants::class);
        $this->command->info('restaurants table seeded!');
        $this->call(Reviews::class);
        $this->command->info('reviews table seeded!');

    }
}
