<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    { 
        $categories = Category::withCount('products')->latest()->paginate(10);
        //$categories->products()->count();
        return view('admin.categories.index', compact('categories'));
    }
}
