<?php
namespace App\Services\Payment\Gateways;

use App\Contracts\PaymentGatewayInterface;
use App\DTO\PaymentData;

class CodPayment implements PaymentGatewayInterface
{
    public function initiate(PaymentData $payment)
    { 
        \Log::info("COD Payment Initiate:--- ".json_encode($payment));

        return [
            'status'=>'success',
            'gateway' => 'cod',
            'payment_status'=>'pending',
            'transaction_id'=>null
        ];
    }

    public function verify(array $payload)
    {
        return true;
    }

    public function refund(string $transactionId,float $amount)
    {
        return false;
    }

    public function webhook(array $payload)
    {

    }
}