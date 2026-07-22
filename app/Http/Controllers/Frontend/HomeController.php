<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Product\ProductService;
use Inertia\Inertia;

class HomeController extends Controller
{
    //

    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $latestProducts = $this->productService->getLatestProducts();

        return Inertia::render('Home', [
            'latestProducts' => $latestProducts,
        ]);
    
    }

    
}
