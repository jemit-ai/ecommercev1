<?php

namespace App\Models\Cart;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Cart extends Model
{
    //
    protected $fillable = [
        'user_id',
        'session_id',
    ];

    protected $table = 'cart';

    public function items()
    {
        return $this->hasMany(CartItems::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
