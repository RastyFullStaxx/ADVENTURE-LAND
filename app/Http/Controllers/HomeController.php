<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get all categories with their products
        $categories = Category::with('products')->get();
        
        // Generate dynamic color mapping
        $colorMap = $this->generateColorMap($categories);
        
        return view('home', compact('categories', 'colorMap'));
    }
    
    /**
     * Generate dynamic color mapping for categories
     */
    private function generateColorMap($categories)
    {
        // Specific color mapping for predefined categories
        $predefinedColors = [
            'Playgrounds' => ['main' => '#0066CC', 'secondary' => '#DAECFF'],
            'Slides' => ['main' => '#8BC43F', 'secondary' => '#EAFFCF'],
            'Climbs' => ['main' => '#EF4445', 'secondary' => '#FFD7D7'],
            'Ball Pits' => ['main' => '#FF9900', 'secondary' => '#FFEBCD'],
            'Packages' => ['main' => '#FF0099', 'secondary' => '#FFDCF1'],
        ];
        
        // Additional colors for any new categories
        $additionalColors = [
            ['main' => '#9966CC', 'secondary' => '#E6D9F2'], // Purple
            ['main' => '#FFD700', 'secondary' => '#FFF8DC'], // Gold
            ['main' => '#00CED1', 'secondary' => '#E0FFFF'], // Dark Turquoise
            ['main' => '#FF6347', 'secondary' => '#FFE4E1'], // Tomato
            ['main' => '#32CD32', 'secondary' => '#F0FFF0'], // Lime Green
            ['main' => '#FF69B4', 'secondary' => '#FFE4F1'], // Hot Pink
            ['main' => '#20B2AA', 'secondary' => '#E0F6F5'], // Light Sea Green
            ['main' => '#DDA0DD', 'secondary' => '#F5F0F5'], // Plum
            ['main' => '#F0E68C', 'secondary' => '#FEFEF0'], // Khaki
            ['main' => '#87CEEB', 'secondary' => '#F0F8FF'], // Sky Blue
        ];
        
        $colorMap = [];
        $additionalColorIndex = 0;
        
        foreach ($categories as $category) {
            // Check if this category has a predefined color
            if (isset($predefinedColors[$category->name])) {
                $colorMap[$category->name] = $predefinedColors[$category->name];
            } else {
                // Assign from additional colors, cycling if necessary
                $colorIndex = $additionalColorIndex % count($additionalColors);
                $colorMap[$category->name] = $additionalColors[$colorIndex];
                $additionalColorIndex++;
            }
        }
        
        return $colorMap;
    }
}