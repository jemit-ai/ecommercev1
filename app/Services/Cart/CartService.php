<?php
namespace App\Services\Cart;

//use App\Models\Product;
use App\Models\Cart\Cart;
use App\Models\Cart\CartItems;
use App\Models\Product\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\DTO\CartData;
use Exception;
use Log;
use App\Exceptions\CartException;

class CartService{ 
 
  /*
  public function getUserCart($userID){
    
    try{

    }catch(Exception $e){

      
      
    }
    
  }

  public function getSessionCart($sessionID){
    
    try{

    }catch(Exception $e){

      
      
    }
    
  }*/

  public function getCart(CartData $cartData){
    
    try{

        $userID = $cartData->userID;
        $sessionID = $cartData->sessionID;

        if ($userID) {

                $cart = Cart::where('user_id', $userID)->first();

        } else {

                $cart = Cart::where('session_id', $sessionID)->first();

        }

        //$cart = Cart::where('user_id', $userID)->orWhere('session_id', $sessionID)->first();
        
        if($cart){

            $cartItem = CartItems::with('product')->where('cart_id', $cart->id)->get()->map(function ($item) {
                            $item->subtotal = $item->quantity * $item->price;
                            return $item;
                        });

            if($cartItem){

                return $cartItem;

            }
        }

     

    }catch(Exception $e){

       Log::error('CartService', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);
      
        return null;
    }
    
  }

  public function addToCart(CartData $cartData):bool{
    
    try{

        DB::transaction(function () use ($cartData) {

            $userID    = $cartData->userID;
            $sessionID = $cartData->sessionID;
            $productID = $cartData->productID;
            $quantity  = $cartData->quantity; 

            if ($userID) {
                $cart = Cart::where('user_id', $userID)->first();
            } else {
                $cart = Cart::where('session_id', $sessionID)->first();
            }

            //$cart = Cart::where('user_id', $userID)->orWhere('session_id', $sessionID)->first();
            
            if($cart){

                $cartItem = CartItems::where('cart_id', $cart->id)->where('product_id', $productID)->first();
                if($cartItem){
                    $cartItem->quantity += $quantity;
                    $cartItem->save();
                }else{

                    if($productID){
                       $product = Product::findOrFail($productID);
                    }

                    CartItems::create([
                        'cart_id'    => $cart->id,
                        'product_id' => $productID,
                        'quantity'   => $quantity,
                        'price' => $product->getPrice()
                    ]);

                }

            }else{

                $cart = Cart::firstOrCreate([
                    'user_id' => $userID,
                    'session_id' => $sessionID,
                ]);

                if($productID){
                    $product = Product::findOrFail($productID);
                }

                CartItems::create([
                    'cart_id'    => $cart->id,
                    'product_id' => $productID,
                    'quantity'   => $quantity,
                    'price' => $product->getPrice()
                ]);

            }

        });

        return true;

    }catch(Exception $e){
        \Log::info("CartService::addToCart: ".$e->getMessage());
        return false;
    }
    
  }

  public function updateCart(CartData $cartData){
    
    try{

        DB::transaction(function () use ($cartData) {

            $userID    = $cartData->userID;
            $sessionID = $cartData->sessionID;
            $productID = $cartData->productID;
            $quantity  = $cartData->quantity;
            $type      = $cartData->type; 

            if ($userID) {
                $cart = Cart::where('user_id', $userID)->first();
            } else {
                $cart = Cart::where('session_id', $sessionID)->first();
            }

            //$cart = Cart::where('user_id', $userID)->orWhere('session_id', $sessionID)->first();
            
            if($cart){

                $cartItem = CartItems::where('cart_id', $cart->id)->where('product_id', $productID)->first();
               
                if($cartItem){

                    $cartItem->quantity += $quantity;
                    $cartItem->save();

                }else{
                    

                    if($productID){
                       $product = Product::findOrFail($productID);
                    }

                    CartItems::create([
                        'cart_id'    => $cart->id,
                        'product_id' => $productID,
                        'quantity'   => $quantity,
                        'price' => $product->getPrice()
                    ]);

                }

            }else{

                $cart = Cart::firstOrCreate([
                    'user_id' => $userID,
                    'session_id' => $sessionID,
                ]);


                if($productID){
                    $product = Product::findOrFail($productID);
                }

                CartItems::create([
                    'cart_id'    => $cart->id,
                    'product_id' => $productID,
                    'quantity'   => $quantity,
                    'price' => $product->getPrice()
                ]);
            }

        });

        return true;
        
    }catch(Exception $e){

       Log::error('CartService', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);
        
        return false;
      
    }
    
  }

  public function removeFromCart(CartData $cartData): bool{

        try {

            DB::transaction(function () use ($cartData) {

                $userID = $cartData->userID;
                $sessionID = $cartData->sessionID;
                $productID = $cartData->productID;

                // Find the cart
                $query = Cart::query();

                if ($userID) {
                    $query->where('user_id', $userID);
                } else {
                    $query->where('session_id', $sessionID);
                }

                $cart = $query->first();

                //dd($query->toRawSql());

                if (!$cart) {
                    return false;
                }

                \Log::info("Cart:-" . json_encode($cart));
                \Log::info("ProId:-".$productID);

                //dd($cart->id);
                // Find the cart item
                $cartItem = CartItems::where('cart_id', $cart->id)
                    ->where('product_id', $productID)
                    ->first();


                \Log::info("CartItem:-" . json_encode($cartItem));
                //dd($cartItem::query()->toRawSql());  

                if (!$cartItem) {
                    return false;
                }

                // Delete the item
                $cartItem->delete();

                // Delete the cart if it has no items left
                if (!CartItems::where('cart_id', $cart->id)->exists()) {
                    $cart->delete();
                }

            });

            return true;

        } catch (Exception $e) {

            Log::error('CartService::removeFromCart', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return false;
        }
  }

  public function clearCart(CartData $cartData){
    
    try{ 

        DB::transaction(function () use ($cartData) {

                $userID = $cartData->userID;
                $sessionID = $cartData->sessionID;

                if ($userID) {
                    $cart = Cart::where('user_id', $userID)->first();
                } else {
                    $cart = Cart::where('session_id', $sessionID)->first();
                }


                //$cart = Cart::where('user_id', $userID)->orWhere('session_id', $sessionID)->first();
                
                if($cart){
                    $cartItem = CartItems::where('cart_id', $cart->id)->first();
                    if($cartItem){
                        $cartItem->delete();
                    }
                }
 
        });

        return true;

    }catch(Exception $e){

        \Log::error('CartService', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);
        
        return false;
      
    }
    
  }

  public function getCartCount(CartData $cartData){
    
    try{ 
        
        $userID = $cartData->userID;
        $sessionID = $cartData->sessionID;

        if ($userID) {
            $cart = Cart::where('user_id', $userID)->first();
        } else {
            $cart = Cart::where('session_id', $sessionID)->first();
        }

        //$cart = Cart::where('user_id', $userID)->orWhere('session_id', $sessionID)->first();
        
        if($cart){
            $cartItem = CartItems::where('cart_id', $cart->id)->first();
            if($cartItem){
                return $cartItem->count();
            }
        }

        return 0;

    }catch(Exception $e){

        \Log::error('CartService', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);
        
        return 0;
      
    }
    
  }

  public function getShippingCharge(CartData $cartData){
    
    try{
        
        $userID = $cartData->userID;
        $sessionID = $cartData->sessionID;

        if ($userID) {
            $cart = Cart::where('user_id', $userID)->first();
        } else {
            $cart = Cart::where('session_id', $sessionID)->first();
        }

        //$cart = Cart::where('user_id', $userID)->orWhere('session_id', $sessionID)->first();
        
        if($cart){

            //$cartItem = CartItems::where('cart_id', $cart->id)->get();

            $cartItem = CartItems::with('product')->where('cart_id', $cart->id)->get()->map(function ($item) {
                            $item->subtotal = $item->quantity * $item->price;
                            return $item;
                        });

            if($cartItem){

                $totalCharge = $cartItem->sum('subtotal'); 

                if($totalCharge > 1000){

                    $shippingCharge=100;

                }else{
                    
                    $shippingCharge=0;

                }

                return $shippingCharge;

            }

        }

        return 0;

    }catch(Exception $e){

        \Log::error('CartService', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);
        
        return 0;
      
    }

  }

}