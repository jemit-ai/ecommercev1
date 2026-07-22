<?php
namespace App\DTO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartData{

    public $userID;

    public $sessionID;
    
    public $productID;

    public $quantity;

    public function __construct($userID,$sessionID,$productID,$quantity) {
        
        $this->userID = $userID;
        $this->sessionID = $sessionID;
        $this->productID = $productID;
        $this->quantity = $quantity;

    }

    public static function fromRequest(Request $request): self
    {
        return new self( 
            userID: auth()->id() ? auth()->id() : null,
            sessionID: $request->session()->getId(),
            productID: (int) $request->product_id,
            quantity: (int) $request->quantity,
        );
    }


}