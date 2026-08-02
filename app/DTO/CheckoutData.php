<?php
namespace App\DTO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutData
{
    public function __construct(
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $email,
        public readonly string $phone,
        public readonly string $address,
        public readonly string $country,
        public readonly string $state,
        public readonly string $zip,
        public readonly string $paymentMethod,
        public readonly array $cartItems,
        public readonly float $shippingCharge,
        public readonly float $totalAmount
    ) {}

    public static function fromArray(array $data): self
    {
        \Log::info("Checkout Data: ", $data);

        return new self(
            firstName: $data['firstName'],
            lastName: $data['lastName'],
            email: $data['email'],
            phone: $data['phone'],
            address: $data['address'],
            country: $data['country'],
            state: $data['state'],
            zip: $data['zip'],
            paymentMethod: $data['payment_method'],
            cartItems: $data['cartItems'],
            shippingCharge: (float) $data['shippingCharge'],
            totalAmount: (float) $data['totalAmount'],
        ); 

    }


}