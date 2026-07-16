<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use Illuminate\View\View;
use App\Jobs\Product\ImportProductsJob;
use App\Models\Product\ProductImport;
use Illuminate\Http\Request;
use App\Models\Category;
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
        return view('admin.products.import');
    }

    public function importStore(Request $request): RedirectResponse
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('csv_file');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $path = $file->move(public_path('imports'), $filename);

        $import = ProductImport::create([
                'filename'=>$filename,
                'filepath'=>$path,
                'status'=>'pending',
        ]);

        ImportProductsJob::dispatch($import);
        
        return back()->with('success','Import Started');
        
    }
}
