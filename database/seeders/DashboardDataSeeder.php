<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order\Order;
use App\Models\Product\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class DashboardDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Users with roles if they don't exist
        $password = Hash::make('password123');

        // Customers
        for ($i = 1; $i <= 5; $i++) {
            $user = User::firstOrCreate(
                ['email' => "customer{$i}@example.com"],
                [
                    'name' => "Customer User {$i}",
                    'password' => $password,
                ]
            );
            $user->assignRole('Customer');
        }

        // Sellers
        for ($i = 1; $i <= 3; $i++) {
            $user = User::firstOrCreate(
                ['email' => "seller{$i}@example.com"],
                [
                    'name' => "Seller Company {$i}",
                    'password' => $password,
                ]
            );
            $user->assignRole('Seller');
        }

        // Suppliers
        for ($i = 1; $i <= 2; $i++) {
            $user = User::firstOrCreate(
                ['email' => "supplier{$i}@example.com"],
                [
                    'name' => "Supplier Corp {$i}",
                    'password' => $password,
                ]
            );
            $user->assignRole('Supplier');
        }

        // 2. Create Categories
        $categoriesData = [
            ['name' => 'Electronics', 'description' => 'Gadgets, devices, and accessories.'],
            ['name' => 'Fashion & Apparel', 'description' => 'Clothing, footwear, and accessories.'],
            ['name' => 'Home & Living', 'description' => 'Furniture, decor, and kitchenware.'],
            ['name' => 'Books & Stationery', 'description' => 'Novels, notebooks, and writing materials.'],
            ['name' => 'Health & Beauty', 'description' => 'Cosmetics, skincare, and wellness products.'],
        ];

        $categories = [];
        foreach ($categoriesData as $cat) {
            $categories[] = Category::firstOrCreate(
                ['slug' => Str::slug($cat['name'])],
                [
                    'name' => $cat['name'],
                    'description' => $cat['description']
                ]
            );
        }

        // 3. Create Products
        $productsData = [
            [
                //'category_idx' => 0,
                'name' => 'Wireless Noise-Cancelling Headphones',
                'description' => 'Premium over-ear wireless headphones with advanced noise cancellation.',
                'price' => 12499.00,
                'discount_price' => 1000.00,
                'stock' => 45,
            ],
            [
                //'category_idx' => 0,
                'name' => 'Smart Watch Series 5',
                'description' => 'Elegant smartwatch with fitness tracking, heart rate monitor, and GPS.',
                'price' => 18999.00,
                'discount_price' => 16999.00,
                'stock' => 30,
            ],
            [
                //'category_idx' => 0,
                'name' => 'Mechanical Gaming Keyboard',
                'description' => 'Tactile RGB mechanical keyboard with blue switches.',
                'price' => 4599.00,
                'discount_price' => 3599.00,
                'stock' => 12,
            ],
            [
                //'category_idx' => 1,
                'name' => 'Classic Leather Jacket',
                'description' => 'High-quality sheepskin leather jacket in vintage black.',
                'price' => 8999.00,
                'discount_price' => 7999.00,
                'stock' => 15,
            ],
            [
                //'category_idx' => 1,
                'name' => 'Runners Breathable Sneakers',
                'description' => 'Lightweight athletic sneakers designed for daily training.',
                'price' => 3499.00,
                'discount_price' => 2499.00,
                'stock' => 50,
            ],
            [
                //'category_idx' => 2,
                'name' => 'Ergonomic Desk Chair',
                'description' => 'High-back mesh office chair with lumbar support and adjustable armrests.',
                'price' => 11999.00,
                'discount_price' => 9999.00,
                'stock' => 8,
            ],
            [
                //'category_idx' => 2,
                'name' => 'Stainless Steel Coffee Maker',
                'description' => '12-cup programmable drip coffee maker with thermal carafe.',
                'price' => 5999.00,
                'discount_price' => 4999.00,
                'stock' => 20,
            ],
            [
                //'category_idx' => 3,
                'name' => 'Hardcover Sci-Fi Novel',
                'description' => 'Award-winning interstellar science fiction novel by a bestseller author.',
                'price' => 799.00,
                'discount_price' => 599.00,
                'stock' => 100,
            ],
            [
                //'category_idx' => 4,
                'name' => 'Organic Aloe Vera Gel',
                'description' => '100% pure cold-pressed soothing moisturizer for skin and hair.',
                'price' => 499.00,
                'discount_price' => 299.00,
                'stock' => 150,
            ],
        ];

        foreach ($productsData as $prod) {
            //$cat = $categories[$prod['category_idx']];
            Product::firstOrCreate(
               // [],
                [
                    //'category_id' => $cat->id,
                    'name' => $prod['name'],
                    //'slug' => Str::slug($prod['name']),
                    'description' => $prod['description'],
                    'price' => $prod['price'],
                    'discount_price' => $prod['discount_price'],
                    'stock' => $prod['stock'],
                ]
            );
        }

        // 4. Create Orders
        $customers = User::role('Customer')->get();
        
        $ordersData = [   
            ['grand_total' => 18999.00, 'order_number'=>'ORD-001','order_status' => 'completed','status' => 'completed', 'created_at' => now()->subDays(5)],
            ['grand_total' => 4599.00, 'order_number'=>'ORD-002','order_status' => 'completed','status' => 'completed', 'created_at' => now()->subDays(4)],
            ['grand_total' => 12499.00, 'order_number'=>'ORD-003','order_status' => 'completed','status' => 'processing', 'created_at' => now()->subDays(3)],
            ['grand_total' => 799.00,'order_number'=>'ORD-004','order_status' => 'completed','status' => 'pending', 'created_at' => now()->subDays(2)],
            ['grand_total' => 3499.00, 'order_number'=>'ORD-005','order_status' => 'completed','status' => 'cancelled', 'created_at' => now()->subDays(1)],
            ['grand_total' => 23998.00,'order_number'=>'ORD-006','order_status' => 'completed', 'status' => 'completed', 'created_at' => now()->subHours(12)],
            ['grand_total' => 5999.00, 'order_number'=>'ORD-007','order_status' => 'completed','status' => 'pending', 'created_at' => now()->subHours(6)],
            ['grand_total' => 1299.00, 'order_number'=>'ORD-008','order_status' => 'completed','status' => 'completed', 'created_at' => now()->subHours(2)],
        ];

        foreach ($ordersData as $idx => $oData) {
            // Assign randomly to seeded customers
            if ($customers->count() > 0) {
                $cust = $customers[$idx % $customers->count()];
                Order::create([
                    'user_id' => $cust->id,
                    'grand_total' => $oData['grand_total'],
                    'status' => $oData['status'],
                    'order_number' => $oData['order_number'],
                    'order_status' => $oData['order_status'],
                    'created_at' => $oData['created_at'],
                    'updated_at' => $oData['created_at'],
                ]);
            }
        }

        
    }
}
