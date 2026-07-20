<?php
namespace App\Services\Product;
use App\Models\Product\Product;

class ProductServices
{
    public function getLatestProducts()
    { 
        try{
           $LatestProducts = Product::latest()->take(8)->get();
           return $LatestProducts;
        }catch (\Exception $e) {
           return $e->getMessage();
        }
    }

    public function getFeaturedProducts()
    {
        return Product::where('featured', true)->take(8)->get();
    }

    public function getProductById($id)
    {
        return Product::find($id);
    }

    public function getProductsByCategory($category)
    {
        return Product::where('category', $category)->take(8)->get();
    }
}
