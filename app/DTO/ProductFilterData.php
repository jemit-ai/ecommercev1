<?php
namespace App\DTO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductFilterData{
 
    public $search; 

    public $category = [];
    
    public $brand = [];

    public $price; 

    public $minprice;

    public $maxprice;


    public function __construct($search,$category,$brand,$price,$minprice,$maxprice) {
        
        $this->search = $search;

        $this->category = $category; 

        $this->brand = $brand;

        $this->price = $price;

        $this->minprice = $minprice;

        $this->maxprice = $maxprice; 

    }

    public static function fromRequest(Request $request): self
    {
        return new self(  
            search: $request->name,
            category: $request->category,
            brand: $request->brand,
            price: (float) $request->price, 
            minprice : (float) $request->minPrice,
            maxprice : (float) $request->maxPrice,
        );
    }


}