<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'status',
    ];
 
    // relatioships 

    public function products(): HasMany{

        return $this->hasMany(Product::class);
        
    }
    
        
}
