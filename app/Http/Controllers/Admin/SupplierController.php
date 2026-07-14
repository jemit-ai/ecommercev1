<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class SupplierController extends Controller
{
    public function index(): View
    {
        $suppliers = User::role('Supplier')->latest()->paginate(10);
        return view('admin.suppliers.index', compact('suppliers'));
    }
}
