<?php

namespace Tests\Feature\Checkout;

use Tests\TestCase;

class CheckoutTest extends TestCase
{
    public function test_checkout_form_can_be_submitted(): void
    {
        $response = $this->post('/checkout/place-order', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'phone' => '9876543210',
            'address' => '123 Main Street',
            'country' => 'India',
            'state' => 'Delhi',
            'zip' => '110001',
            'notes' => 'Leave at gate',
            'payment_method' => 'cod',
            'shippingCharge' => 50,
            'totalAmount' => 500,
        ]);

        $response->assertRedirect('/');
    }
}
