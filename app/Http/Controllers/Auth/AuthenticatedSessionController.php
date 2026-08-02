<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
use App\Services\Cart\CartService;
use App\DTO\CartDTO;

class AuthenticatedSessionController extends Controller
{

    /**
     * Display the login view.
     */
    public function create_old(): View
    {
        //Log::info("Hii from login controller");
        return view('auth.login');
    }

    public function __construct(private CartService $cartService) {

    }


    public function create()
    {   

        return Inertia::render('Auth/Login');
        
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        Log::info("Hii from login controller"); 

        $request->authenticate();

        //$oldSessionId = $request->session()->getId();
 
        $request->session()->regenerate();

        $user         = Auth::user();

        if ($user){

            //$sessionId = session()->getId();

            // Log::info("Old Session::" . $sessionId); 

            $guestSessionId = session()->get('guest_session_id');

            Log::info("User Logged In::" . json_encode($user));  

            Log::info("Guest Session ID::" . $guestSessionId); 

            //$sessionIdExisting = $request->session()->getId();
            if($guestSessionId){

             $this->cartService->mergeSessionCart($guestSessionId, $user);

            }

        }

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        //return redirect('/');

        return redirect()->route('login');

        //return Inertia::location(route('login')); 

    }
}
