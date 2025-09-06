<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;

    // ShoppingCart belongs to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ShoppingCart has many ShoppingCartItems
    public function items()
    {
        return $this->hasMany(ShoppingCartItem::class);
    }
}
