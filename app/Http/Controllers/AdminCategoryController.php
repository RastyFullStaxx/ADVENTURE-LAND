<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ActivityLog;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created category in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
        ]);

        $category = Category::create($validated);

        // Log the activity
        ActivityLog::create([
            'user_id'     => auth()->id(),
            'action'      => 'Added Category',
            'subject_type'=> 'Category',
            'subject_id'  => $category->id,
        ]);

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Category added successfully!');
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified category in the database.
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        // Log the activity
        ActivityLog::create([
            'user_id'     => auth()->id(),
            'action'      => 'Updated Category',
            'subject_type'=> 'Category',
            'subject_id'  => $category->id,
        ]);

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified category from the database.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $categoryId = $category->id;
        $category->delete();

        // Log the activity
        ActivityLog::create([
            'user_id'     => auth()->id(),
            'action'      => 'Deleted Category',
            'subject_type'=> 'Category',
            'subject_id'  => $categoryId,
        ]);

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Category deleted successfully!');
    }
}
