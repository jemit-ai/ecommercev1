<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Order\OrderController;


  

    Route::middleware('auth:sanctum')->group(function () {

        Route::post('/order', [OrderController::class, 'store']);      // Place order

        
    });

     
    Route::middleware(['guest.token'])->group(function () { 

        Route::post('/guest/order', [OrderController::class, 'createGuestOrder']);      // Place order
        Route::post('/guest/order/{id}/status', [OrderController::class, 'updateStatus']);

        //Route::get('/orders', [OrderController::class, 'index']);        // List user orders
        //Route::get('/orders/{id}', [OrderController::class, 'show']);     // Order details
        //Route::post('/orders/{id}/cancel', [OrderController::class, 'cancel']); // Cancel order
        
    });


