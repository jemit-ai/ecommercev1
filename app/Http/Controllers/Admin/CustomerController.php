<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function index(): View
    {
        $customers = User::role('Customer')->latest()->paginate(10);
        return view('admin.customers.index', compact('customers'));
    }
}
