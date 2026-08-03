<?php

namespace App\Services\Payment\Gateways;

use App\Contracts\PaymentGatewayInterface;
use App\DTO\PaymentData;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class PaypalPayment implements PaymentGatewayInterface
{
    private $client_id;
    private $client_secret;
    private $mode;
    private $base_url;

    public function __construct()
    {
        $this->mode = config('services.paypal.mode');

        $this->client_id = config('services.paypal.client_id');

        $this->client_secret = config('services.paypal.client_secret');

        $this->base_url = $this->mode == 'sandbox'
            ? 'https://api-m.sandbox.paypal.com'
            : 'https://api-m.paypal.com';
    }

    public function initiate(PaymentData $payment): array
    {
        Log::info('PayPal Initiate', (array) $payment);

        $token = $this->createOAuthAccessToken();

        if ($token['status'] != 'success') {
            return $token;
        }

        $order = $this->createOrder($payment, $token['access_token']);

        if (isset($order['status']) && $order['status'] == 'error') {
            return $order;
        }

        $approvalUrl = null;

        foreach ($order['links'] as $link) {
            if ($link['rel'] == 'approve') {
                $approvalUrl = $link['href'];
                break;
            }
        }

        return [
            'status'       => 'success',
            'gateway'      => 'paypal',
            'order_id'     => $order['id'],
            'approval_url' => $approvalUrl,
            'response'     => $order,
        ];
    }

    private function createOAuthAccessToken(): array
    {
        try {

            $credentials = base64_encode($this->client_id . ':' . $this->client_secret);

            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Accept-Language' => 'en_US',
                'Authorization' => 'Basic ' . $credentials,
            ])
            ->asForm()
            ->post($this->base_url . '/v1/oauth2/token', [
                'grant_type' => 'client_credentials',
            ]);

            if (!$response->successful()) {

                Log::error('PayPal Token Error', [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);

                return [
                    'status' => 'error',
                    'gateway' => 'paypal',
                    'message' => 'Unable to generate access token',
                ];
            }

            return [
                'status' => 'success',
                'gateway' => 'paypal',
                'access_token' => $response['access_token'],
            ];

        } catch (Exception $e) {

            Log::error($e->getMessage());

            return [
                'status' => 'error',
                'gateway' => 'paypal',
                'message' => $e->getMessage(),
            ];
        }
    }

    private function createOrder(PaymentData $payment, string $accessToken): array
    {
        try {

            $response = Http::withToken($accessToken)
                ->acceptJson()
                ->post($this->base_url . '/v2/checkout/orders', [

                    'intent' => 'CAPTURE',

                    'purchase_units' => [
                        [
                            'reference_id' => $payment->orderId,
                            'amount' => [
                                'currency_code' => $payment->currency,
                                'value' => number_format($payment->amount, 2, '.', ''),
                            ],
                        ],
                    ],

                    'application_context' => [
                        'return_url' => route('paypal.success'),
                        'cancel_url' => route('paypal.cancel'),
                        'user_action' => 'PAY_NOW',
                    ],

                ]);

            if (!$response->successful()) {

                Log::error('PayPal Create Order Error', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return [
                    'status' => 'error',
                    'gateway' => 'paypal',
                    'message' => 'Unable to create PayPal order',
                ];
            }

            return $response->json();

        } catch (Exception $e) {

            Log::error($e->getMessage());

            return [
                'status' => 'error',
                'gateway' => 'paypal',
                'message' => $e->getMessage(),
            ];
        }
    }

    public function verify(array $payload)
    {
        return true;
    }

    public function refund(string $transactionId, float $amount)
    {
        return false;
    }

    public function webhook(array $payload)
    {
    }
}