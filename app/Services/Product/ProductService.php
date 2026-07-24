<?php
namespace App\Services\Product;
use App\Models\Product\Product;
use App\Models\Brand;
use App\Models\Category;
use App\DTO\ProductFilterData;

class ProductService
{
    public function getLatestProducts(){ 
        try{
           $LatestProducts = Product::latest()->take(8)->get();
           return $LatestProducts;
        }catch (\Exception $e) {
           return $e->getMessage();
        }
    }

    public function getFeaturedProducts(){
        return Product::where('featured', true)->take(8)->get();
    }

    public function getProductById($id){
        return Product::find($id);
    }

    public function getProductsByCategory($category){
        return Product::where('category', $category)->take(8)->get();
    }

    public function getAllProducts($ProductFilterData){ 
        try{

           //$Products = Product::latest()->take(100)->get();

           $query = Product::query();

           if (!empty($ProductFilterData->search)) {

             $query->orWhere('name', 'like', '%' . $ProductFilterData->search . '%');

           }

           if (!empty($ProductFilterData->category)) {

            \Log::info('Category:-' . $ProductFilterData->category);

            $query->orWhere('category_id', $ProductFilterData->category);
            
           }

           if (!empty($ProductFilterData->brand)) {

            \Log::info('Brand:-' . $ProductFilterData->brand);

            $query->orWhere('brand_id', $ProductFilterData->brand);

           }

           /*if (!empty($ProductFilterData->price)) {
 
            $query->where('price', $ProductFilterData->price);
            
           }*/ 

           if (!empty($ProductFilterData->minprice) && !empty($ProductFilterData->maxprice)) {

            $query->whereBetween('price', [$ProductFilterData->minprice, $ProductFilterData->maxprice]);

            \Log::info('Min Price:-' . $ProductFilterData->minprice);
            \Log::info('Max Price:-' . $ProductFilterData->maxprice);

            //\Log::info('Query:-' . $query->ddRawSql()); 

           }
           
           $Products = $query->take(100)->get();

           return $Products;

        }catch (\Exception $e) {
           return $e->getMessage();
        }
    }
    
    public function getMinPrice(){

        try{
           return Product::min('price');
        }catch(\Exception $e){
            return $e->getMessage();
        }

    }

    public function getMaxPrice(){

        try{
            return Product::max('price');
        }catch(\Exception $e){
            return $e->getMessage();
        }

    }

    public function getAllCategories(){

        try{
            return Category::all();
        }catch(\Exception $e){
            return $e->getMessage();
        }

    }

    public function getAllBrands(){

        try{
            return Brand::all();
        }catch(\Exception $e){
            return $e->getMessage();
        }

    }
}
