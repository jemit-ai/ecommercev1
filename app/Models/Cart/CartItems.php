<?php

namespace App\Models\Cart;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product\Product;

class CartItems extends Model
{
    //
    protected $fillable = [
        'cart_id',
        'product_id',
        'product_variant_id',
        'quantity',
        'price', 
    ];

    protected $table = 'cart_items';

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }

    
}
