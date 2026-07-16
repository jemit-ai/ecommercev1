<?php
namespace App\DTO;
class PaymentData
{
    public function __construct(
        public int $orderId,
        public float $amount,
        public string $currency,
        public string $paymentMethod,
        public ?int $userId=null
    ){}
}