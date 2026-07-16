<?php
namespace App\Contracts;

use App\DTO\PaymentData;

interface PaymentGatewayInterface
{
    public function initiate(PaymentData $payment);

    public function verify(array $payload);

    public function refund(string $transactionId,float $amount);

    public function webhook(array $payload);
    
}