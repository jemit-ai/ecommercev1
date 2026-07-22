<?php
namespace App\Services\Cart;

use App\Models\Product;
use App\Models\Cart\Cart;
use App\Models\Cart\CartItems;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\DTO\CartData;
use Exception;

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

        $cart = Cart::where('user_id', $userID)->orWhere('session_id', $sessionID)->first();
        
        if($cart){
            $cartItem = CartItems::where('cart_id', $cart->id)->first();
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

        $userID = $cartData->userID;
        $sessionID = $cartData->sessionID;
        $productID = $cartData->productID;
        $quantity = $cartData->quantity;

        $cart = Cart::where('user_id', $userID)->orWhere('session_id', $sessionID)->first();
        
        if($cart){
            $cartItem = CartItems::where('cart_id', $cart->id)->where('product_id', $productID)->first();
            if($cartItem){
                $cartItem->quantity += $quantity;
                $cartItem->save();
            }else{
                $cartItem = new CartItems();
                $cartItem->cart_id = $cart->id;
                $cartItem->product_id = $productID;
                $cartItem->quantity = $quantity;
                $cartItem->save();
            }
        }else{
            $cart = new Cart();
            $cart->user_id = $userID;
            $cart->session_id = $sessionID;
            $cart->save();
            $cartItem = new CartItems();
            $cartItem->cart_id = $cart->id;
            $cartItem->product_id = $productID;
            $cartItem->quantity = $quantity;
            $cartItem->save();
        }

        return true;

    }catch(Exception $e){
        \Log::info("CartService::addToCart: ".$e->getMessage());
        return false;
    }
    
  }

  public function updateCart(CartData $cartData){
    
    try{

        $userID = $cartData->userID;
        $sessionID = $cartData->sessionID;
        $productID = $cartData->productID;
        $quantity = $cartData->quantity;

        $cart = Cart::where('user_id', $userID)->orWhere('session_id', $sessionID)->first();
        
        if($cart){
            $cartItem = CartItems::where('cart_id', $cart->id)->where('product_id', $productID)->first();
            if($cartItem){
                $cartItem->quantity += $quantity;
                $cartItem->save();
            }else{
                $cartItem = new CartItems();
                $cartItem->cart_id = $cart->id;
                $cartItem->product_id = $productID;
                $cartItem->quantity = $quantity;
                $cartItem->save();
            }
        }else{
            $cart = new Cart();
            $cart->user_id = $userID;
            $cart->session_id = $sessionID;
            $cart->save();
            $cartItem = new CartItems();
            $cartItem->cart_id = $cart->id;
            $cartItem->product_id = $productID;
            $cartItem->quantity = $quantity;
            $cartItem->save();
        }

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

            if (!$cart) {
                return false;
            }

            // Find the cart item
            $cartItem = CartItems::where('cart_id', $cart->id)
                ->where('product_id', $productID)
                ->first();

            if (!$cartItem) {
                return false;
            }

            // Delete the item
            $cartItem->delete();

            // Delete the cart if it has no items left
            if (!CartItems::where('cart_id', $cart->id)->exists()) {
                $cart->delete();
            }

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

        $userID = $cartData->userID;
        $sessionID = $cartData->sessionID;

        $cart = Cart::where('user_id', $userID)->orWhere('session_id', $sessionID)->first();
        
        if($cart){
            $cartItem = CartItems::where('cart_id', $cart->id)->first();
            if($cartItem){
                $cartItem->delete();
            }
        }

        return true;

    }catch(Exception $e){

        \Log::error('CartService', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);
        
        return false;
      
    }
    
  }

}