<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Cart\CartService;
use App\DTO\CartData;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use App\Exceptions\Cart\CartException; 

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

        \Log::info("Cart Store Request Data::->" . json_encode($request));  
    
        $cartData = CartData::fromRequest($request);   
        
        \Log::info("Cart Data::->" . json_encode($cartData)); 
        
        try{

            $cart = $this->cartService->addToCart($cartData);  
                
            \Log::info("Cart Store:->" . json_encode($cart));  

            //return Inertia::render('Home'); 

            return back()->with('success', 'Product added to cart.');

        }catch(CartException $e){

            \Log::info("Cart Store Error:->" . $e->getMessage());

        }               

    }
    
    public function destroy(Request $request){

        \Log::info('Delete...'); 

        $cartData = CartData::fromRequest($request);  
        
        \Log::info("Cart Data::->" . json_encode($cartData));  

        try{
         
            $cart = $this->cartService->removeFromCart($cartData); 

            \Log::info("Cart Remove:->" . json_encode($cart));

            return back()->with('success', 'Product removed from cart.');

        }Catch(CartException $e){

            \Log::info("Cart Remove Error:->" . $e->getMessage());

        }

    }
     
    public function update(Request $request){
        
    }
    
    public function clear(Request $request){

    }
       
}
