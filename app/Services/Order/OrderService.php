<?php
namespace App\Services\Order;

use App\Models\Order\Order;
use App\Models\Order\OrderDetail;
use App\Models\Product\Product;
use App\Models\Order\OrderTimeline;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Event;
use App\Events\Order\OrderPaid;
use App\Events\Order\OrderCancelled;
use App\Services\Order\InventoryService;
use App\Events\Order\OrderPlaced;
use App\Services\Payment\PaymentService;

use Exception;

class OrderService
{

    public function __construct(public InventoryService $inventoryService,public PaymentService $paymentService){}
    
    public function create(array $data)
    {

        \Log::info("Order created...");
        
        try{
             
            //\Log::info($data);

            $transactionResult = DB::transaction(function () use ($data) {

                //$coupon_code    = $data['coupon_code']; 
                $payment_method = $data['payment_method'];
                $grand_total    = $data['grand_total']; 

                \Log::info("Order grand Total...".$grand_total);   
               
                $order = Order::create([ 
                    'user_id'        => auth()->id() ? auth()->id() : 1,
                    'order_number'   => Str::random(10),
                    'payment_method' => $payment_method,
                    'grand_total'    => $grand_total,
                    'payment_id'     => 1,
                    'order_status'   => 'pending',
                ]);

                foreach ($data['items'] as $item) {


                    $product = Product::findOrFail($item['product_id']);

                    OrderDetail::create([
                        'order_id'   => $order->id,
                        'product_id' => $product->id,
                        'price'      => $product->price,
                        'quantity'   => $item['quantity'],
                        'total'      => $product->price * $item['quantity'],
                    ]);

                    // Reduce Stock
                    // $product->decrement('stock', $item['quantity']);
                    //$this->inventoryService->reserveStock($product, $item['quantity']);

                }
                
                //\Log::info("Order created...".print_r($order,true));
                
                $payment = $this->paymentService->initiate($order);

                //\Log::info("#Payment Information To Controller :- ".json_encode($payment)); 


                /*if ($payment instanceof \Illuminate\Http\RedirectResponse) {
                    return [
                        'order' => $order,
                        'redirect' => $payment,
                    ];
                }*/
 
                return [
                    'order' => $order,
                    'payment' => $payment,
                ];

            });

            if (isset($transactionResult['order'])) {
                DB::afterCommit(function () use ($transactionResult) {
                    OrderPlaced::dispatch($transactionResult['order']); 
                });
            }

            /*if (isset($transactionResult['redirect'])) {
                return $transactionResult['redirect'];
            }*/

            $order = $transactionResult['order'];
            $order->payment = $transactionResult['payment'];
            return $order; 
            
            
        }catch(Exception $e){
            DB::rollBack();
            throw $e;
        }

    }

    public function confirm(Order $order):bool{

        try{

            $order = DB::transaction(function () use ($order) {

                $order->update([
                    'order_status'   => 'confirmed',
                ]);

                return $order;

            });

            DB::afterCommit(function () use ($order) {
                \Log::info('Dispatching OrderPaid event' .$order->id);

                OrderPaid::dispatch($order); 
            }); 
            
            return true;

        }catch(Exception $e){
            DB::rollBack();
            throw $e;
        }

    }

    public function cancel(Order $order){

        try{

            $order = DB::transaction(function () use ($order) {

                $order->update([
                    'order_status'   => 'cancelled',
                ]);

                /*foreach ($order->details as $item) {

                    $product = Product::findOrFail($item['product_id']);

                    $product->increment('stock', $item['quantity']);
                }*/

                DB::afterCommit(function () use ($order) { 

                    \Log::info('Dispatching OrderPaid event' .$order->id); 
                    OrderCancelled::dispatch($order); 

                });                 

                return $order;
            });

            
            return $order;

        }catch(Exception $e){
            DB::rollBack();
            throw $e;
        }

    }

    public function generateOrderNo(Order $order){

        \Log::info("Order number generation started");

        // $order = Order::find($order->id);
        // $order->update([
        //     'order_number' => Str::random(10),
        // ]); 

        try{

            $order = Order::find($order->id);
            $order->update([
            'order_number' => 'ORD-' . now()->format('YmdHis') . '-' . strtoupper(Str::random(4)),
            ]); 

        }catch(Exception $e){

            \Log::info("Error in generating order number: {$e->getMessage()}"); 
            
        }
        

    }

    public function getOrderById($id){

        $order=""; 
        try{
            $order=Order::find($id);
        }catch(\Exception $e){
            \Log::info('OrderDetails'. $e->getMessage() . 'File:--->'.__FILE__.__LINE__);
        }
        return $order;
    }

    /*
    public function createTimeLine(Order $order)
    { 
        try{

            OrderTimeline::create([
                'order_id'   => $order->id,
                'user_id'    => $order->user_id,
                'status'     => $order->order_status,
                'title'      => 'Order Placed',
                'description'=> 'Your order has been placed successfully.',
                'created_by' => $order->user_id,
                'event_time' => now(),
            ]);

        }catch(Exception $e){

            \Log::info("Error in creating timeline: {$e->getMessage()}"); 
            
        }    

    }
    */
}