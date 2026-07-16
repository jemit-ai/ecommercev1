<?php 
namespace App\Services\Payment\Gateways;

use App\Contracts\PaymentGatewayInterface;
use App\DTO\PaymentData;
use Razorpay\Api\Api;

class RazorpayPayment implements PaymentGatewayInterface
{

    protected $api;
    public function __construct()
    {
        $this->api = new Api(config('services.razorpay.key'), 
                              config('services.razorpay.secret'));
    }

    public function initiate(PaymentData $payment)
    {
        //create razorpay order

        try{

            $amount = $payment->amount * 100; // Convert ₹ to paise

            $options = [
                'receipt' => $payment->orderId,
                'amount' => $amount,
                'currency' => $payment->currency ?? 'INR',
                'payment_capture' => 1, // Optional in newer Razorpay API versions
            ];

            $razorpayOrder = $this->api->order->create($options);

            return [
                'order_id' => $razorpayOrder['id'],
                'amount' => $razorpayOrder['amount'],
                'currency' => $razorpayOrder['currency'],
                'key' => config('services.razorpay.key'),
            ];

        }catch(Exception $e){
            
            \Log::info("Razorpay Payment Initiate:--- ".json_encode($payment));

            return [
                'status'=>'error',
                'gateway' => 'razorpay',
                'payment_status'=>'pending',
                'transaction_id'=>null
            ];

        }

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