<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permissions = [

            // Dashboard
            'dashboard.view',

            // Products
            'product.view',
            'product.create',
            'product.edit',
            'product.delete',

            // Categories
            'category.view',
            'category.create',
            'category.edit',
            'category.delete',

            // Orders
            'order.view',
            'order.create',
            'order.edit',
            'order.cancel',

            // Customers
            'customer.view',
            'customer.edit',

            // Sellers
            'seller.view',
            'seller.approve',

            // Suppliers
            'supplier.view',
            'supplier.approve',

            // Reports
            'report.view',

            // Users
            'user.view',
            'user.create',
            'user.edit',
            'user.delete',

            // Settings
            'setting.manage',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }
    }
}
