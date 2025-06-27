<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\ActivityLog;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.admin', [
            'productCount' => Product::count(),
            'categoryCount' => Category::count(),
            'userCount' => User::where('role', '!=', 'admin')->count(),
            'activityLogs' => ActivityLog::with('user')->latest()->take(10)->get(),
        ]);
    }
}
