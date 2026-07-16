<?php

namespace App\Services\Payment;

use App\Contracts\PaymentGatewayInterface;
use App\Services\Payment\Gateways\CodPayment;
use App\Services\Payment\Gateways\RazorpayPayment;
use App\Services\Payment\Gateways\StripePayment;
use App\Services\Payment\Gateways\PaypalPayment;

class PaymentManager
{
    public function driver(string $method): PaymentGatewayInterface
    {
        return match($method){

            'cod' => app(CodPayment::class),

            'razorpay' => app(RazorpayPayment::class),

            'stripe' => app(StripePayment::class),

            'paypal' => app(PaypalPayment::class),

            default => throw new Exception('Unsupported Payment Gateway'),
        };
    }
}