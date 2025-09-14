<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCartItem extends Model
{
    use HasFactory;

    protected $fillable = ['shopping_cart_id', 'product_item_id', 'quantity'];

    // ShoppingCartItem belongs to ShoppingCart
     public function shoppingCart()
    {
        return $this->belongsTo(ShoppingCart::class, 'shopping_cart_id')->onDelete('cascade'); // Cascade delete on shopping cart deletion
    }

    // ShoppingCartItem belongs to ProductItem
    public function productItem()
    {
        return $this->belongsTo(ProductItem::class, 'product_item_id')->onDelete('cascade'); // Cascade delete on product item deletion
    }
}
