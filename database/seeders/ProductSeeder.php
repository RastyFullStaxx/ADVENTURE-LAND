<?php

namespace Database\Seeders;

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
            ['Playgrounds', 'Bounce House', 'Perfect for fun jumping activities.', 6500, '4.2 (L) x 4.5 (W) x 4 (H) m', 'playgrounds/imgBounceHouse.png'],
            ['Playgrounds', 'Obstacle Castle', 'Colorful obstacle playground.', 10500, '9 (L) x 4 (W) x 3.7 (H) m', 'playgrounds/imgObstacleCastle.png'],
            ['Playgrounds', 'Play House', 'Interactive play space.', 6500, '6 (L) x 5 (W) x 3.5 (H) m', 'playgrounds/imgPlayHouse.png'],
            ['Playgrounds', 'Balloon Dome', 'Unique inflatable dome.', 7000, '5 (L) x 5 (W) x 4 (H) m', 'playgrounds/imgBalloonDome.png'],

            // 🟩 Slides 
            ['Slides', 'Dolphin Slide', 'Ocean-themed fun slide.', 9000, '6.5 (L) x 4 (W) x 4.5 (H) m', 'slides/imgDolphin.png'],
            ['Slides', 'Giant Double Slide', 'Double lanes for double fun.', 9000, '8 (L) x 5 (W) x 5.5 (H) m', 'slides/imgGiantDouble.png'],
            ['Slides', 'Double Slide', 'Classic twin slide.', 9000, '6.5 (L) x 4 (W) x 4.5 (H) m', 'slides/imgDouble.png'],
            ['Slides', 'Vertical Rush', 'Challenging climb & slide.', 9000, '9 (L) x 4 (W) x 5.5 (H) m', 'slides/imgVerticalRush.png'],
            ['Slides', 'Rainbow Slide', 'Colorful rainbow design.', 9000, '7 (L) x 4.5 (W) x 4.7 (H) m', 'slides/imgRainbow.png'],
            ['Slides', 'Castle Slide', 'Slide with fantasy theme.', 9000, '7.5 (L) x 4 (W) x 4.5 (H) m', 'slides/imgCastle.png'],
            ['Slides', 'Single Slide', 'Simple single-lane fun.', 9000, '6 (L) x 4 (W) x 4 (H) m', 'slides/imgSingle.png'],
            ['Slides', 'Giant Wall Slide', 'Big challenge for climbers.', 9000, '8.5 (L) x 4.5 (W) x 5.5 (H) m', 'slides/imgGiantWall.png'],

            // 🟥 Climbs
            ['Climbs', 'Mini Wall Climb', 'Compact climbing fun.', 8000, '5.5 (L) x 4 (W) x 3.5 (H) m', 'climbs/imgMiniWall.png'],
            ['Climbs', 'Giant Wall Climb', 'Large climbing wall.', 9000, '8.5 (L) x 4.5 (W) x 5.5 (H) m', 'climbs/imgGiantWall.png'],
            ['Climbs', 'Vertical Rush', 'Vertical climbing rush.', 9000, '9 (L) x 4 (W) x 5.5 (H) m', 'climbs/imgVerticalRush.png'],

            // 🟧 Ball Pits
            ['Ball Pits', 'Ball Pit Set', 'Soft play pit.', 7000, '3.5 (L) x 3.5 (W) x 2.5 (H) m', 'ball_pits/imgBallPitSet.png'],
            ['Ball Pits', 'Big Round Ball Pit', 'Large circular pit.', 7000, '3.5 (diameter) x 2 (H) m', 'ball_pits/imgBigRoundBallPit.png'],

            // 🩷 Packages (Updated with correct filenames and folder paths)
            ['Packages', 'Play Set A', 'Perfect event bundle.', 15000, '12ft x 18ft x 10ft', 'package/simple/imgBounce-SingleSlide-PlayHouse-RollerCoaster_Simple.png'],
            ['Packages', 'Combo Set 1', 'Giant Double Slide & Bounce House.', 16000, '15ft x 22ft x 12ft', 'package/simple/imgBounceHouse-GiantDoubleSlide-RollerCoaster-Simple.png'],
            ['Packages', 'Combo Set 2', 'Bounce & Double Slide Setup.', 15500, '14ft x 20ft x 11ft', 'package/simple/imgBounceHouse-RollerCoaster-Bounce-DoubleSlide-Package_Simple.png'],
            ['Packages', 'Combo Set 3', 'Vertical Rush Pack.', 15000, '16ft x 20ft x 14ft', 'package/simple/imgBounceHouse-VerticalRush-RollerCoaster-Simple.png'],
            ['Packages', 'Wall Climb Combo', 'Giant Wall & Bounce Combo.', 15500, '18ft x 24ft x 15ft', 'package/simple/imgGiantWallClimb-BounceHouse-RollerCoaster_Simple.png'],
            ['Packages', 'Mini Climb Combo', 'Play House & Mini Climb.', 14500, '10ft x 16ft x 9ft', 'package/simple/imgMiniWallClimb-PlayHouse-RollerCoaster_Simple.png'],
            ['Packages', 'Obstacle Combo', 'Obstacle Castle & Play House.', 14500, '13ft x 19ft x 10ft', 'package/simple/imgPlayHouse-ObstacleCastle-RollerCoaster_Simple.png'],
            ['Packages', 'Rainbow Bounce Set', 'Rainbow Slide & Bounce House.', 15000, '14ft x 21ft x 11ft', 'package/simple/imgRainbowSlide-BounceHouse-RollerCoaster_Simple.png'],
        ];

        foreach ($products as [$cat, $name, $desc, $price, $dimension, $image]) {
            Product::create([
                'category_id' => $categories[$cat],
                'name' => $name,
                'description' => $desc,
                'price' => $price,
                'dimension_long' => $dimension,
                'inventory_quantity' => 10,
                'image_path' => $image
            ]);
        }
    }
}
