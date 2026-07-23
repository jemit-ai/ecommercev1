<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Brand;
use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductBrand extends Model
{
    //
    use HasFactory;

    protected $table = 'product_brands';

    protected $fillable = [
        'product_id',
        'brand_id',
    ];

    // relatiosn

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    
}
