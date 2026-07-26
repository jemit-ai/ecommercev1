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

  public function mergeSessionCart($sessionIdExisting, $user){

        //$userID = $cartData->userID;
        //$sessionID = $cartData->sessionID; 

        //Log::info("@@@@CartDTO :-" . json_encode($user)); 

        //Log::info("@@@@CartDTO SessionID :-" . json_encode($sessionIdExisting)); 


        try{

            DB::transaction(function () use ($sessionIdExisting, $user) {

                // Guest cart
                $sessionCart = Cart::where('session_id', $sessionIdExisting)  
                    ->with('items')
                    ->first(); 

                if (!$sessionCart) {
                    return;
                }

                if (!$user || !isset($user->id)) {
                    return;
                }

                // User cart
                $userCart = Cart::firstOrCreate(
                    ['user_id' => $user->id],
                    ['session_id' => null]
                );

                foreach ($sessionCart->items as $item) {

                    // Check if same product already exists
                    $existingItem = CartItems::where('cart_id', $userCart->id)
                        ->where('product_id', $item->product_id)
                        ->where('product_variant_id', $item->product_variant_id)
                        ->first();

                    if ($existingItem) {

                        // Increase quantity
                        $existingItem->quantity += $item->quantity;
                        $existingItem->subtotal = $existingItem->quantity * $existingItem->price;
                        $existingItem->save();

                    } else {

                        // Move item
                        $item->cart_id = $userCart->id;
                        $item->save();
                    }
                }

                // Delete empty session cart
                $sessionCart->delete();

            });

        }Catch(Exception $e){ 

            Log::error('CartService Session Merge', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'line' => __LINE__,
                'file' => __FILE__,
            ]);
            
            return false;
          
        }

   }


}