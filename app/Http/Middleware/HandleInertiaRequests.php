<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use App\Services\Cart\CartService;
use App\DTO\CartData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    //protected $rootView = 'frontend.layouts.app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {

        $cartData = CartData::fromRequest($request);    
        
       // Log::info("Middleware Cart Data::->" . print_r($cartData, true));

        $cartCount = app(CartService::class)->getCartCount($cartData);  

        //Log::info("CartCount::->" . $cartCount);  

        return [
            ...parent::share($request),
            'cartCount' => $cartCount, 
            'auth' => [
                    'user' => $request->user()
                            ? [
                                'id' => $request->user()->id,
                                'name' => $request->user()->name,
                                'roles' => $request->user()->getRoleNames(),
                                'permissions' => $request->user()->getAllPermissions()->pluck('name'),
                            ]
                            : null,
            ],
            //
        ];
    }
}
