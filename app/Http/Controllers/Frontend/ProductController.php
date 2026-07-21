<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    //
     
    public function products(){

        return Inertia::render('Product');

    }
    
    public function productDetail()
    {

        return Inertia::render('ProductDetail');

    }

}
