<?php 
namespace App\Services\Payment\Gateways;

use App\Contracts\PaymentGatewayInterface;
use App\DTO\PaymentData;

class RazorpayPayment implements PaymentGatewayInterface
{
    public function initiate(PaymentData $payment)
    {
        //create razorpay order

        return [
            'redirect_url'=>$url,
            'gateway_order_id'=>$orderId,
            'status'=>'pending'
        ];
    }

    public function verify(array $payload)
    {

    }

    public function refund(string $transactionId,float $amount)
    {

    }

    public function webhook(array $payload)
    {

    }
}