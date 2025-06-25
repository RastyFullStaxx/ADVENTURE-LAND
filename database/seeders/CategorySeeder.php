<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::insert([
            [
                'name' => 'Playgrounds',
                'description' => 'Perfect for jumping & interactive play'
            ],
            [
                'name' => 'Slides',
                'description' => 'Perfect for sliding'
            ],
            [
                'name' => 'Climbs',
                'description' => 'Perfect for climbing'
            ],
            [
                'name' => 'Ball Pits',
                'description' => 'Perfect for diving into soft fun'
            ],
            [
                'name' => 'Packages',
                'description' => 'Perfect for event bundles'
            ],
        ]);
    }
}
