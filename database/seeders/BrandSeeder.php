<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            'Apple',
            'Samsung',
            'Sony',
            'LG',
            'Dell',
            'HP',
            'Lenovo',
            'Asus',
            'Acer',
            'Xiaomi',
        ];

        foreach ($brands as $brand) {
            Brand::updateOrCreate(
                ['slug' => Str::slug($brand)],
                [
                    'name' => $brand,
                    'slug' => Str::slug($brand),
                    'status' => 'active',
                ]
            );
        }
    }
}