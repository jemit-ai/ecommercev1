<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CartService;
use App\DTO\CartData;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class CartController extends Controller
{
    //
    private CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index(){

    }
    
    public function store(Request $request){

        $cartData = CartData::fromRequest($request);  

        try{

            $this->cartService->addToCart($cartData); 

        }catch(CartException $e){
            
            \Log::info($e->getMessage());
        }               

    }
    
    public function destroy(Request $request){

    }
     
    public function update(Request $request){
        
    }
    
    public function clear(Request $request){

    }
       
}
