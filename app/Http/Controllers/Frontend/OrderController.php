<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Services\Cart\CartService;
use Illuminate\Support\Facades\Auth;
use App\DTO\CartData;
use App\Models\Products\Product;

class OrderController extends Controller
{
    //

    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }


    public function CheckOut(Request $request)
    {

        $CartData = CartData::fromRequest($request); 

        //\Log::info('Request Data:'.json_encode($CartData));  

        $cartItems      = $this->cartService->getCart($CartData);

        $shippingCharge = $this->cartService->getShippingCharge($CartData);

        if($this->cartService->getCartCount($CartData) == 0){
            //return Inertia::redirect()->route('/');
            return redirect()->route('home');
        }
        
        $totalAmount = $cartItems->sum(function ($item) {
            return $item->subtotal;
        });
            
        $totalAmount = $totalAmount + $shippingCharge;
        
        //\Log::info('Cart Items:'.json_encode($cartItems));   
        //$total     = $this->cartService->getTotal();

        return Inertia::render('Check',[ 
            'cartItems' => $cartItems,
            'shippingCharge' => $shippingCharge, 
            'totalAmount' => $totalAmount, 
        ]);

    }

}
