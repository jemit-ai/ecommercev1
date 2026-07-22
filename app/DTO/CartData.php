<?php
namespace App\DTO;
use Illuminate\Http\Request;

class CartData{

    public $userID;

    public $sessionID;

    public $productID;

    public $quantity;


    public static function fromRequest(Request $request): self
    {
        return new self( 
            userID: $request->user()?->id,
            sessionID: $request->session()->getId(),
            productID: (int) $request->product_id,
            quantity: (int) $request->quantity,
        );
    }


}