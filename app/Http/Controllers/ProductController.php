<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all categories with their associated products
        $categories = \App\Models\Category::with('products')->get();

        return view('products.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    // app/Http/Controllers/ProductController.php
    public function show(Product $product)
    {
        $styleConfig = [
            'Playgrounds' => ['main' => '#99CCFF', 'secondary' => '#DAECFF'],
            'Slides'      => ['main' => '#8BC43F', 'secondary' => '#EAFFCF'],
            'Climbs'      => ['main' => '#EF4445', 'secondary' => '#FFD7D7'],
            'Ball Pits'   => ['main' => '#FF9900', 'secondary' => '#FFEBCD'],
            'Packages'    => ['main' => '#FF0099', 'secondary' => '#FFDCF1'],
        ];

        $categoryName = $product->category->name;
        $colors = $styleConfig[$categoryName] ?? ['main' => '#000', 'secondary' => '#f5f5f5'];

        $product->inclusions = [
            'Transportation Fee',
            'Rubber Matting',
            '4 hours of continuous playtime',
            'Dedicated staff available for setup & assistance',
        ];

        $products = Product::orderBy('id')->get();
        $currentIndex = $products->search(fn($p) => $p->id === $product->id);

        $isFirst = $currentIndex === 0;
        $isLast = $currentIndex === $products->count() - 1;

        $prevProduct = !$isFirst ? $products[$currentIndex - 1] : null;
        $nextProduct = !$isLast ? $products[$currentIndex + 1] : null;

        return view('products.details', [
            'product' => $product,
            'categoryName' => $categoryName,
            'mainColor' => $colors['main'],
            'secondaryColor' => $colors['secondary'],
            'isFirst' => $isFirst,
            'isLast' => $isLast,
            'prevProduct' => $prevProduct,
            'nextProduct' => $nextProduct,
        ]);
    }


    public function redirectToFirstProduct($slug)
    {
        // Find the category by slug
        $category = Category::where('slug', $slug)->firstOrFail();
    
        // Get first product in that category
        $firstProduct = $category->products()->first();
    
        if ($firstProduct) {
            return redirect()->route('products.show', ['product' => $firstProduct->id]);
        } else {
            return redirect('/')->with('error', 'No product found for this category.');
        }
    }    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    
}
