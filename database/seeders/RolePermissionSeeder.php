<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         $admin = Role::findByName('Admin');
        $seller = Role::findByName('Seller');
        $supplier = Role::findByName('Supplier');
        $customer = Role::findByName('Customer');

        // Admin
        $admin->syncPermissions(
            \Spatie\Permission\Models\Permission::all()
        );

        // Seller
        $seller->syncPermissions([
            'dashboard.view',
            'product.view',
            'product.create',
            'product.edit',
            'order.view',
            'report.view',
        ]);

        // Supplier
        $supplier->syncPermissions([
            'dashboard.view',
            'product.view',
            'order.view',
        ]);

        // Customer
        $customer->syncPermissions([
            'dashboard.view',
            'order.view',
        ]);

    }
}
