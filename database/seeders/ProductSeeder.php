<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Playgrounds' => Category::where('name', 'Playgrounds')->first()->id,
            'Slides' => Category::where('name', 'Slides')->first()->id,
            'Climbs' => Category::where('name', 'Climbs')->first()->id,
            'Ball Pits' => Category::where('name', 'Ball Pits')->first()->id,
            'Packages' => Category::where('name', 'Packages')->first()->id,
        ];

        $products = [
            // 🟦 Playgrounds
            ['Playgrounds', 'Bounce House', 'Perfect for fun jumping activities.', 6500, 'playgrounds/imgBounceHouse.png'],
            ['Playgrounds', 'Obstacle Castle', 'Colorful obstacle playground.', 10500, 'playgrounds/imgObstacleCastle.png'],
            ['Playgrounds', 'Play House', 'Interactive play space.', 6500, 'playgrounds/imgPlayHouse.png'],
            ['Playgrounds', 'Balloon Dome', 'Unique inflatable dome.', 7000, 'playgrounds/imgBalloonDome.png'],

            // 🟩 Slides (fun car and bamboo removed)
            ['Slides', 'Dolphin Slide', 'Ocean-themed fun slide.', 9000, 'slides/imgDolphin.png'],
            ['Slides', 'Giant Double Slide', 'Double lanes for double fun.', 9000, 'slides/imgGiantDouble.png'],
            ['Slides', 'Double Slide', 'Classic twin slide.', 9000, 'slides/imgDouble.png'],
            ['Slides', 'Vertical Rush', 'Challenging climb & slide.', 9000, 'slides/imgVerticalRush.png'],
            ['Slides', 'Rainbow Slide', 'Colorful rainbow design.', 9000, 'slides/imgRainbow.png'],
            ['Slides', 'Castle Slide', 'Slide with fantasy theme.', 9000, 'slides/imgCastle.png'],
            ['Slides', 'Single Slide', 'Simple single-lane fun.', 9000, 'slides/imgSingle.png'],
            ['Slides', 'Giant Wall Slide', 'Big challenge for climbers.', 9000, 'slides/imgGiantWall.png'],

            // 🟥 Climbs
            ['Climbs', 'Mini Wall Climb', 'Compact climbing fun.', 8000, 'climbs/imgMiniWall.png'],
            ['Climbs', 'Giant Wall Climb', 'Large climbing wall.', 9000, 'climbs/imgGiantWall.png'],
            ['Climbs', 'Vertical Rush', 'Vertical climbing rush.', 9000, 'climbs/imgVerticalRush.png'],

            // 🟧 Ball Pits
            ['Ball Pits', 'Ball Pit Set', 'Soft play pit.', 7000, 'ball_pits/imgBallPitSet.png'],
            ['Ball Pits', 'Big Round Ball Pit', 'Large circular pit.', 7000, 'ball_pits/imgBigRoundBallPit.png'],

            // 🩷 Packages (Updated with correct filenames and folder paths)
            ['Packages', 'Play Set A', 'Perfect event bundle.', 15000, 'package/simple/imgBounce-SingleSlide-PlayHouse-RollerCoaster_Simple.png'],
            ['Packages', 'Combo Set 1', 'Giant Double Slide & Bounce House.', 16000, 'package/simple/imgBounceHouse-GiantDoubleSlide-RollerCoaster-Simple.png'],
            ['Packages', 'Combo Set 2', 'Bounce & Double Slide Setup.', 15500, 'package/simple/imgBounceHouse-RollerCoaster-Bounce-DoubleSlide-Package_Simple.png'],
            ['Packages', 'Combo Set 3', 'Vertical Rush Pack.', 15000, 'package/simple/imgBounceHouse-VerticalRush-RollerCoaster-Simple.png'],
            ['Packages', 'Wall Climb Combo', 'Giant Wall & Bounce Combo.', 15500, 'package/simple/imgGiantWallClimb-BounceHouse-RollerCoaster_Simple.png'],
            ['Packages', 'Mini Climb Combo', 'Play House & Mini Climb.', 14500, 'package/simple/imgMiniWallClimb-PlayHouse-RollerCoaster_Simple.png'],
            ['Packages', 'Obstacle Combo', 'Obstacle Castle & Play House.', 14500, 'package/simple/imgPlayHouse-ObstacleCastle-RollerCoaster_Simple.png'],
            ['Packages', 'Rainbow Bounce Set', 'Rainbow Slide & Bounce House.', 15000, 'package/simple/imgRainbowSlide-BounceHouse-RollerCoaster_Simple.png'],
        ];

        foreach ($products as [$cat, $name, $desc, $price, $image]) {
            Product::create([
                'category_id' => $categories[$cat],
                'name' => $name,
                'description' => $desc,
                'price' => $price,
                'inventory_quantity' => 10,
                'image_path' => $image
            ]);
        }
    }
}