<?php

namespace Database\Seeders;

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
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            CitySeeder::class,
            StatusSeeder::class,
            RoomSeeder::class,
            ImageSeeder::class,
            RatingSeeder::class,
            BookingSeeder::class,
            // BookingDetailSeeder::class,
        ]);
    }
}
