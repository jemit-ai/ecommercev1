<?php
namespace App\Listeners\OrderPlaced;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Events\Order\OrderPlaced;
use App\Services\Order\InventoryService;
use Illuminate\Support\Facades\Log;

class ReserveInventory implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct(public InventoryService $inventoryService)
    {
        //
    }

    /**
     * Handle the event.
     */ 
    public function handle(object $event): void
    {
        // 
        try{
           
          //\Log::info("Event: " . json_encode($event));
 
          \Log::info("### Listner Inventory Service.");   
          //\Log::info("#### Order: " . $event->order);
          //\Log::info("#### Order Details: " . $event->order->details);
          //\Log::info("#### Order ID: " . $event->order->id);
          //\Log::info("#### Order Event: " . $event->payment);  

          Log::info('Event: ' . json_encode([
              'order' => $event->order,
              'payment' => $event->payment,
          ]));
          //\Log::info("#### Order payment id: " . $event->payment_id);
          //\Log::info("#### Payment Order ID: " . $event->payment->order_id);           
          
          //$this->inventoryService->deductStock($event->order);

        }catch(Exception $e){

          \Log::info("Inventory update failed for order ".$e->getMessage()." at line ".$e->getLine());

        } 

    }
}
