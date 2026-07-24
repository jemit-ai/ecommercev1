<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\ProductController;
use Inertia\Inertia;
use App\Http\Middleware\HandleInertiaRequests;

Route::controller(HomeController::class)->group(function () {

    //Route::get('/', 'index')->name('home');

    Route::get('/','index')->name('home'); 

    Route::get('/about', 'about')->name('about');

    Route::get('/contact', 'contact')->name('contact');

    Route::get('/shop', 'shop')->name('shop');

    Route::get('/search', 'search')->name('search');

});

Route::controller(ProductController::class)->group(function () {

    Route::get('/product_detail','productDetail')->name('product.detail'); 

    Route::get('/products','products')->name('product.list');      

    Route::post('/product','productToCart')->name('product.toCart');  
      
});

Route::controller(OrderController::class)->group(function () {

    Route::get('/checkout','CheckOut')->name('order.index');  

});

Route::middleware(['web'])->prefix('cart')->controller(CartController::class)->group(function () {

    Route::get('/', 'index')->name('cart.index');

    Route::post('/add', 'store')->name('cart.store');

    Route::patch('/update/{cart}', 'update')->name('cart.update');

    //Route::delete('/remove/{cart}', 'destroy')->name('cart.destroy');

    Route::post('/remove', 'destroy')->name('cart.destroy'); 

    Route::delete('/clear', 'clear')->name('cart.clear');

});

/*

Route::middleware(['auth','role:Customer'])->prefix('wishlist')
    ->controller(WishlistController::class)
    ->group(function () {

        Route::get('/', 'index')->name('wishlist.index');

        Route::post('/add/{product}', 'store')->name('wishlist.store');

        Route::delete('/remove/{product}', 'destroy')->name('wishlist.destroy');

});
 
Route::middleware(['auth','role:Customer'])->prefix('checkout')
    ->controller(CheckoutController::class)
    ->group(function () {

        Route::get('/', 'index')->name('checkout.index');

        Route::post('/place-order', 'store')->name('checkout.store');

        Route::get('/success/{order}', 'success')->name('checkout.success');

});

Route::middleware(['auth','verified','role:Customer'])
    ->prefix('customer')
    ->name('customer.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('customer.dashboard');
        })->name('dashboard');

        Route::resource('orders', OrderController::class)
            ->only(['index','show']);

        Route::resource('profile', ProfileController::class)
            ->only(['index','update']);

});

*/

