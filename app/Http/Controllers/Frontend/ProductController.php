<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Services\Product\ProductService;
use App\DTO\ProductFilterData;

class ProductController extends Controller
{
    //
    
    protected $productService;
    
    public function __construct(ProductService $productService){

        $this->productService = $productService;

    }
    
     
    public function products(Request $request){ 
        
        \Log::info('ReqAll:', $request->all());

        $ProductFilterData = ProductFilterData::fromRequest($request); 

        \Log::info('ProductFilterData:'. json_encode($ProductFilterData)); 

        $allProducts = $this->productService->getAllProducts($ProductFilterData);

        $minPrice    = $this->productService->getMinPrice();

        $maxPrice    = $this->productService->getMaxPrice();

        $categories  = $this->productService->getAllCategories();

        $brands      = $this->productService->getAllBrands();

        return Inertia::render('Product', [
            'products' => $allProducts,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    

    } 
    
    public function productDetail(){

        return Inertia::render('ProductDetail');

    }

    public function productToCart(Request $request){ 

        $productID = $request->productID;
         
    } 

}
