<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia; 


class PaymentController extends Controller
{
    //
    public function Success(Request $request)
    {
        return Inertia::render('Success'); 
    }
    
    public function Cancel(Request $request)
    {
        return Inertia::render('Cancel');
    }
    
}
