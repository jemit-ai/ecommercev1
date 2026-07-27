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
use Illuminate\Support\Facades\Log;
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

  public $totalAmt=0; 

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
                          
                            // $item->subtotal = $item->quantity * $item->price;

                            $item->subtotal = number_format($item->quantity * $item->price, 2, '.', '');
                            
                            //$totalAmt += $item->subtotal;

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

            session()->put('guest_session_id', $sessionID);

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
        Log::info("CartService::addToCart: ".$e->getMessage());
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

                Log::info("Cart:-" . json_encode($cart));
                Log::info("ProId:-".$productID);

                //dd($cart->id);
                // Find the cart item
                $cartItem = CartItems::where('cart_id', $cart->id)
                    ->where('product_id', $productID)
                    ->first();


                Log::info("CartItem:-" . json_encode($cartItem));
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

    Log::error('CartService', [
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


        //\Log::info("CartService::getCartCount->" . json_encode($cart)); 

        //\Log::info("CartService::getCartCount ID->" . json_encode($cart->id));

        //$cart = Cart::where('user_id', $userID)->orWhere('session_id', $sessionID)->first();
        
        if($cart){ 

            $cartItem = CartItems::where('cart_id', $cart->id)->get();

            if($cartItem){

                return $cartItem->count();

            }

        }

        return 0;

    }catch(Exception $e){

        Log::error('CartService', [
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
                    $shippingCharge=number_format($shippingCharge, 2, '.', '');

                }else{
                    
                    $shippingCharge=0;
                    $shippingCharge=number_format($shippingCharge, 2, '.', '');;

                }

                return $shippingCharge;

            }

        }

        return 0;

    }catch(Exception $e){

        Log::error('CartService', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);
        
        return 0;
      
    }

  }

  public function getTotalAmt(CartData $cartData){
    
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

            $cartItem = CartItems::where('cart_id', $cart->id)->selectRaw('SUM(price * quantity) as total')->value('total');

            if($cartItem){

                //return $cartItem;

                return number_format($cartItem, 2, '.', ''); 

            }
             
        }

        return 0;

    }catch(Exception $e){

        Log::error('CartService', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);
        
        return 0;
      
    }
    
  }
  
  public function mergeSessionCart(string $sessionId, $user): bool{

        if (!$user || empty($user->id)) {
            return false;
        }

        try {
            DB::transaction(function () use ($sessionId, $user) {

                Log::info("Merge Session Cart: " . json_encode($sessionId));

                // Retrieve guest cart with its items
                $guestCart = Cart::with('items')
                    ->where('session_id', $sessionId)
                    ->first();

                Log::info("Guest Cart ID::->" . json_encode($guestCart)); 

                if (!$guestCart) {
                    return;
                }

                // Retrieve existing user cart or create a new one
                $userCart = Cart::firstOrCreate(
                    ['user_id' => $user->id],
                    ['session_id' => null]
                );

                Log::info("User Cart ID::->" . json_encode($userCart));

                // Nothing to merge
                if ($guestCart->id === $userCart->id) {
                    return;
                }

                foreach ($guestCart->items as $guestItem) {

                    $userItem = CartItems::where('cart_id', $userCart->id)
                        ->where('product_id', $guestItem->product_id)
                        ->where('product_variant_id', $guestItem->product_variant_id)
                        ->first();

                    if ($userItem) {

                        // Merge quantities
                        $userItem->quantity += $guestItem->quantity;
                        $userItem->subtotal = $userItem->quantity * $userItem->price;
                        $userItem->save();

                        // Remove duplicate guest item
                        $guestItem->delete();

                    } else {

                        // Move guest item to user's cart
                        $guestItem->update([
                            'cart_id' => $userCart->id,
                        ]);
                    }
                }

                // Remove guest cart after all items are merged
                $guestCart->delete();
            });

            return true;

        } catch (\Throwable $e) {

            Log::error('Failed to merge guest cart into user cart.', [
                'user_id'    => $user->id,
                'session_id' => $sessionId,
                'message'    => $e->getMessage(),
                'file'       => $e->getFile(),
                'line'       => $e->getLine(),
                'trace'      => $e->getTraceAsString(),
            ]);

            return false;
        }

  }


}