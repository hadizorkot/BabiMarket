<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCartItem extends Model
{
    use HasFactory;

    // ShoppingCartItem belongs to ShoppingCart
    public function shoppingCart()
    {
        return $this->belongsTo(ShoppingCart::class);
    }

    // ShoppingCartItem belongs to ProductItem
    public function productItem()
    {
        return $this->belongsTo(ProductItem::class);
    }
}
