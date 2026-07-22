<?php
namespace App\Services\Product;
use App\Models\Product\Product;
use App\DTO\ProductFilterData;

class ProductService
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

    public function getAllProducts($ProductFilterData)
    { 
        try{

           //$Products = Product::latest()->take(100)->get();

           $query = Product::query();

           if (!empty($ProductFilterData->search)) {

             $query->where('name', 'like', '%' . $ProductFilterData->search . '%');

           }

           if (!empty($ProductFilterData->category)) {

            $query->where('category_id', $ProductFilterData->category);
            
           }

           if (!empty($ProductFilterData->brand)) {

            $query->where('brand_id', $ProductFilterData->brand);

           }

           if (!empty($ProductFilterData->price)) {

            $query->where('price', $ProductFilterData->price);
            
           }
           
           $Products = $query->get();

           return $Products;

        }catch (\Exception $e) {
           return $e->getMessage();
        }
    }
    
}
