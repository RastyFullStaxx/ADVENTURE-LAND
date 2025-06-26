<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySlugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Playgrounds', 'description' => 'Perfect for jumping & interactive play.', 'slug' => 'playgrounds'],
            ['name' => 'Slides', 'description' => 'Perfect for sliding.', 'slug' => 'slides'],
            ['name' => 'Climbs', 'description' => 'Perfect for climbing.', 'slug' => 'climbs'],
            ['name' => 'Ball Pits', 'description' => 'Perfect for diving into soft fun.', 'slug' => 'ball-pits'],
            ['name' => 'Packages', 'description' => 'Perfect for event bundles.', 'slug' => 'packages'],
        ];
        
        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
        
    }
}
