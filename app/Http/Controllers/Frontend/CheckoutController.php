<?php
namespace App\Http\Controllers\Frontend;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\DTO\CartData;
use App\DTO\CheckoutData;
use App\Services\Order\OrderService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
class CheckoutController extends Controller
{

    public OrderService $orderService;

    public function __construct(OrderService $orderService) {

        $this->orderService = $orderService; 
        
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'country' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:20',
            'payment_method' => 'required|string',
            'cartItems' => 'required|array',
            'shippingCharge' => 'required|numeric',
            'totalAmount' => 'required|numeric',
        ]); 

        $subtotal = collect($validated['cartItems'])->sum(function ($item) {

            return $item['price'] * $item['quantity']; 

        }); 

        $data = [ 

                'items' => collect($validated['cartItems'])->map(fn ($item) => [
                        'product_id' => $item['product_id'],
                        'quantity'   => $item['quantity'],
                ])->toArray(),

                //'coupon_code' => $validated['coupon_code'] ?? null,
                'payment_method' => $validated['payment_method'],  
                'grand_total'  => $subtotal, 

        ];

        //\Log::info('Data for Order Creation: ' . json_encode($data)); 

        //return false;    
       
        
        try {

            $order = $this->orderService->create($data);

            //\Log::info("Order Response in Controller :--- ".json_encode($order));   

            //$paypalStatus = $order->payment['response']['status'];

            if($order){   

                   // Your application status
                   $paymentStatus = $order->payment['status'];

                   // PayPal status
                   $paypalStatus = $order->payment['response']['status'];

                   // Your application status
                   $gateway = $order->payment['gateway'];

                   // Payment Link
                   $approval_url = $order->payment['approval_url'];


                        return Inertia::render('Process', [ 
                           //'order' => $order, 
                           'gateway' => $gateway,
                           'approval_url' => $approval_url,
                        ]);


        
            }

            //\Log::info("Order Response in Controller :--- ".json_encode($order));  

            
        } catch (Exception $e) {

            \Log::info("Order Error: " . $e->getMessage()."Line: ".$e->getLine()."File: ".$e->getFile()); 

            return redirect()->route('home')->with('error', 'Unable to place order.');

        }

        

    }
}
