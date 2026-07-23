<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Category;
use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCategory extends Model
{
    //
    use HasFactory;

    protected $table = 'product_category';
    
    protected $fillable = [
        'product_id',
        'category_id',
    ];

    // relatiosn

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
