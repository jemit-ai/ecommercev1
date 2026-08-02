<?php

namespace Tests\Unit;

use App\DTO\CheckoutData;
use PHPUnit\Framework\TestCase;

class CheckoutDataTest extends TestCase
{
    public function test_from_array_supports_snake_case_checkout_payload(): void
    {
        $checkoutData = CheckoutData::fromArray([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'phone' => '9876543210',
            'address' => '123 Main Street',
            'country' => 'India',
            'state' => 'Delhi',
            'zip' => '110001',
            'payment_method' => 'cod',
            'cartItems' => [['id' => 1, 'quantity' => 2]],
            'shippingCharge' => '50',
            'totalAmount' => '500',
        ]);

        $this->assertSame('John', $checkoutData->firstName);
        $this->assertSame('Doe', $checkoutData->lastName);
        $this->assertSame('cod', $checkoutData->paymentMethod);
        $this->assertSame(50.0, $checkoutData->shippingCharge);
        $this->assertSame(500.0, $checkoutData->totalAmount);
    }
}
