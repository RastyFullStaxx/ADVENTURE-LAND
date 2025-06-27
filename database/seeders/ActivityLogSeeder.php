<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Support\Str;

class ActivityLogSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->warn('No users found. Please seed users first.');
            return;
        }

        foreach (range(1, 20) as $i) {
            $user = $users->random();

            ActivityLog::create([
                'user_id'     => $user->id,
                'action'      => fake()->randomElement(['Added Product', 'Updated Product', 'Deleted Category', 'Edited User']),
                'subject_type'=> fake()->randomElement(['Product', 'Category', 'User']),
                'subject_id'  => fake()->numberBetween(1, 20),
                'created_at'  => now()->subDays(rand(0, 10))->subMinutes(rand(0, 60)),
            ]);
        }
    }
}
