<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order\Order; 
use App\Models\Product\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View; 

class DashboardController extends Controller
{
    public function index(): View
    {
        $products = Product::count();
        $orders = Order::count();
        $customers = User::role('Customer')->count();
        
        $revenue = Order::whereIn('status', ['completed', 'processing'])->sum('grand_total');

        $recentOrders = Order::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('products', 'orders', 'customers', 'revenue', 'recentOrders'));
    }
}
