<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created product in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'               => 'required|string|max:255',
            'category_id'        => 'required|exists:categories,id',
            'description'        => 'nullable|string',
            'price'              => 'required|numeric',
            'dimension_long'     => 'nullable|string',
            'inventory_quantity' => 'required|integer|min:0',
            'extra_fee'          => 'nullable|numeric',
            'units'              => 'nullable|string',
            'image'              => 'required|image|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $validated['image_path'] = $imageName;
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product added successfully!');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product in the database.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name'               => 'required|string|max:255',
            'category_id'        => 'required|exists:categories,id',
            'description'        => 'nullable|string',
            'price'              => 'required|numeric',
            'dimension_long'     => 'nullable|string',
            'inventory_quantity' => 'required|integer|min:0',
            'extra_fee'          => 'nullable|numeric',
            'units'              => 'nullable|string',
            'image'              => 'nullable|image|max:2048',
        ]);

        // Handle new image upload (optional)
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $validated['image_path'] = $imageName;
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified product from the database.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }
}
