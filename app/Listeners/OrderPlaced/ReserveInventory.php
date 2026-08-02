<?php
namespace App\Listeners\OrderPlaced;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Events\Order\OrderPlaced;
use App\Services\Order\InventoryService;
use Exception;

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
          
          \Log::info("### Listner Inventory Service.");   
          \Log::info("#### Order: " . $event->order);
          \Log::info("#### Order Details: " . $event->order->details);
          \Log::info("#### Order ID: " . $event->order->id);
          \Log::info("#### Order Number: " . $event->order->order_number);
          
          
          //$this->inventoryService->deductStock($event->order);

        }catch(Exception $e){

          \Log::info("Inventory update failed for order {$event->order->id}  {$e->getMessage()}");

        } 

    }
}
