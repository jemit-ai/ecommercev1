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

        $cartItemsList  = $this->cartService->getCart($CartData);  

        \Log::info('Cart Items List:'.json_encode($cartItemsList));  

        //$cartArray      = $cartItemsList->toArray(); 

        $cartItems      = $cartItemsList['cartItems'];
        $totalAmt       = $cartItemsList['totalAmt'];  

        \Log::info('Cart Items:'.json_encode($cartItems));  
        \Log::info('Cart Total Amount:'.json_encode($totalAmt));  
        

        $shippingCharge = $this->cartService->getShippingCharge($CartData);

        if($this->cartService->getCartCount($CartData) == 0){
            return redirect()->route('home');
        }

        //$totalAmount = 10;
            
        //$totalAmount = $totalAmount + $shippingCharge;
        
        //\Log::info('Cart Items:'.json_encode($cartItems));   
        //$total     = $this->cartService->getTotal();

        return Inertia::render('Check',[ 
            'cartItems' => $cartItems,
            'shippingCharge' => $shippingCharge, 
            'totalAmount' => $totalAmt, 
        ]);

    }

}
