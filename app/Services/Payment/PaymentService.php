<?php
namespace App\Services\Payment;

use App\Models\Order\Order;
use App\DTO\PaymentData;

class PaymentService 
{
    public function __construct(
        private PaymentManager $manager
    ){}

    public function initiate(Order $order)
    {
        
        \Log::info("Order initiate:--- ".json_encode($order)); 
        
        $gateway = $this->manager->driver($order->payment_method);
        
        \Log::info("Order Gateway:--- ".json_encode($gateway));  
        //exit();     
        // \Log::info("Gateway:--- ".print_r($gateway)); 
        \Log::info("Payment ID:--- ".$order->id);
        \Log::info("Payment Amount:--- ".$order->grand_total);
        \Log::info("Payment Currency:--- ".$order->currency);
        \Log::info("Payment Method:--- ".$order->payment_method);
        \Log::info("Payment User ID:--- ".$order->user_id); 
        
        return $gateway->initiate(
            new PaymentData(
                orderId:$order->id,
                amount:$order->grand_total,
                currency:'INR',
                paymentMethod:$order->payment_method,
                userId:$order->user_id
            )
        );
        
    }
}