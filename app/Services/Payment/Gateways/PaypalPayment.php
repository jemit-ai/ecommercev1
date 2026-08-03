<?php
namespace App\Services\Payment\Gateways;
use App\Contracts\PaymentGatewayInterface;
use App\DTO\PaymentData;
use Illuminate\Support\Facades\Http;

class PaypalPayment implements PaymentGatewayInterface
{

    private $client_id;
    private $client_secret;
    private $mode;
    private $base_url;


    public function __construct()
    {

        $this->mode = config("services.paypal.mode");

        $this->client_id = config("services.paypal.client_id");

        $this->client_secret = config("services.paypal.client_secret");

        $this->base_url = ($this->mode === 'sandbox') 
            ? 'https://api-m.sandbox.paypal.com'
            : 'https://api-m.paypal.com';

    }



    public function initiate(PaymentData $payment): Array
    {  

        \Log::info("Paypal Payment Initiate:--- ".json_encode($payment));

        $token = $this->createOAuthAccessToken();

        if(isset($token['status']) && $token['status'] == 'success'){  

            //\Log::info(' Paypal Access Token:---- '.$token['access_token']);
            $order = $this->createOrder($payment,$token['access_token']);

        }else{

            return [
                'status' => 'error',
                'gateway' => 'paypal', 
                'message' => 'Failed to get access token'
            ];

        }

    }

    private function createOAuthAccessToken():Array
    {

        try{

            $credentials = base64_encode("$this->client_id:$this->client_secret");

            // 2. Get Access Token
            $tokenResponse = Http::withHeaders([
                'Accept' => 'application/json',
                'Accept-Language' => 'en_US',
                'Authorization' => 'Basic ' . $credentials
            ])->post("$this->base_url/v1/oauth2/token", [
                'grant_type' => 'client_credentials'
            ]);

            if ($tokenResponse->failed()) {

                return [
                    'status' => 'error',
                    'gateway' => 'paypal',
                    'message' => 'Failed to get access token'
                ];

            }

            $accessToken = $tokenResponse->json('access_token');

            return [
                'status' => 'success',
                'gateway' => 'paypal',
                'access_token' => $accessToken
            ];

        }Catch(Execption $e){ 
 
            \Log::info('Error paypal access token :----- '.$e->getMessage());
            
            return [
                'status' => 'error',
                'gateway' => 'paypal', 
                'message' => $e->getMessage()
            ];

        }
        
       
    }

    private function createOrder(PaymentData $payment,string $accessToken){ 

        try{ 

             $response = Http::withToken($accessToken)->withHeaders(['Content-Type' => 'application/json',])
                ->post($this->base_url . '/v2/checkout/orders', [ 
                    'intent' => 'CAPTURE',
                    'purchase_units' => [
                        [
                            'amount' => [
                                'currency_code' => 'USD',
                                'value' => '10.00',
                            ],
                        ],
                    ],

                    'application_context' => [
                        'return_url' => route('paypal.success'),
                        'cancel_url' => route('paypal.cancel'),
                    ],
                ]);

            $order = $response->json();

            return $order;


        }Catch(Execption $e){

            \Log::info('Error paypal create order :----- '.$e->getMessage());
            
            return [
                'status' => 'error',
                'gateway' => 'paypal', 
                'message' => $e->getMessage()
            ];

        }

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