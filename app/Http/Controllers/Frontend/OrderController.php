<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;



class OrderController extends Controller
{
    //
    public function CheckOut()
    {
        return Inertia::render('Check'); 
    }

}
