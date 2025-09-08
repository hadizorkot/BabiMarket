<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    use HasFactory;

    protected $fillable = ['product_item_id', 'order_id','quantity', 'price'];

    // OrderLine belongs to ShopOrder
    public function shopOrder()
    {
        return $this->belongsTo(ShopOrder::class);
    }

    // OrderLine belongs to ProductItem
    public function productItem()
    {
        return $this->belongsTo(ProductItem::class);
    }
}
