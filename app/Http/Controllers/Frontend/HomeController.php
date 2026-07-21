<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Product\ProductServices;
use Inertia\Inertia;

class HomeController extends Controller
{
    //

    protected $productServices;

    public function __construct(ProductServices $productServices)
    {
        $this->productServices = $productServices;
    }

    public function index()
    {
        $latestProducts = $this->productServices->getLatestProducts();

        return Inertia::render('Home', [
            'latestProducts' => $latestProducts,
        ]);
    
    }

    
}
