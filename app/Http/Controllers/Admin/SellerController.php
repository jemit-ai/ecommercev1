<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class SellerController extends Controller
{
    public function index(): View
    {
        $sellers = User::role('Seller')->latest()->paginate(10);
        return view('admin.sellers.index', compact('sellers'));
    }
}
