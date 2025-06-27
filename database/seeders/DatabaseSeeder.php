<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UserSeeder::class, // ✅ Call your custom seeder
        ]);

        $this->call([
            CategorySeeder::class,
            ProductSeeder::class, // Only after CategorySeeder
        ]);

        $this->call(ActivityLogSeeder::class);
        
    }
}
