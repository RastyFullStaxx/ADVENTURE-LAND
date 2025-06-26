<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Playgrounds', 'description' => 'Perfect for jumping & interactive play'],
            ['name' => 'Slides', 'description' => 'Perfect for sliding'],
            ['name' => 'Climbs', 'description' => 'Perfect for climbing'],
            ['name' => 'Ball Pits', 'description' => 'Perfect for diving into soft fun'],
            ['name' => 'Packages', 'description' => 'Perfect for event bundles'],
        ];

        foreach ($categories as $data) {
            Category::create([
                'name' => $data['name'],
                'description' => $data['description'],
                'slug' => Str::slug($data['name']), // ✅ Add slug explicitly
            ]);
        }
    }
}
