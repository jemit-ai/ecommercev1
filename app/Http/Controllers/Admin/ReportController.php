<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(): View
    {
        $productsCount = Product::count();
        $ordersCount = Order::count();
        $completedOrdersCount = Order::where('status', 'completed')->count();
        $revenue = Order::whereIn('status', ['completed', 'processing'])->sum('grand_total');
        
        $customerCount = User::role('Customer')->count();
        $sellerCount = User::role('Seller')->count();
        $supplierCount = User::role('Supplier')->count();

        return view('admin.reports.index', compact(
            'productsCount', 
            'ordersCount', 
            'completedOrdersCount', 
            'revenue', 
            'customerCount', 
            'sellerCount', 
            'supplierCount'
        ));
    }
}
