<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use Illuminate\View\View;
use App\Jobs\Product\ImportProductsJob;
use App\Models\Product\ProductImport;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function import()
    {
        //Get All Categories
        $categories = Category::latest()->get();

        //Get All Brands 
        $brands = Brand::latest()->get();
        
        return view('admin.products.import' , compact('categories', 'brands'));
    }

    public function importStore(Request $request): RedirectResponse
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('csv_file');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $path = $file->move(public_path('imports'), $filename);

        $category_id = $request->category_id;
        $brand_id    = $request->brand_id;
        
        $import = ProductImport::create([
                'filename'=>$filename,
                'filepath'=>$path,
                'status'=>'pending',
                'category_id'=>$category_id,
                'brand_id'=>$brand_id,
        ]);

        ImportProductsJob::dispatch($import);
        
        return back()->with('success','Import Started');
        
    }
}
