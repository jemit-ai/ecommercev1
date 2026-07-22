<?php
namespace App\DTO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductFilterData{
 
    public $search; 

    public $category;
    
    public $brand;

    public $price; 

    public function __construct($search,$category,$brand,$price) {
        
        $this->search = $search;

        $this->category = $category; 

        $this->brand = $brand;

        $this->price = $price;

    }

    public static function fromRequest(Request $request): self
    {
        return new self(  
            search: $request->name,
            category: $request->category,
            brand: (int) $request->brand,
            price: (int) $request->price, 
        );
    }


}