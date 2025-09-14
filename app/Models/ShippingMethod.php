<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price'];
    

    // ShippingMethod has many ShopOrders
    public function shopOrders()
    {
        return $this->hasMany(ShopOrder::class, 'shipping_method_id');
    }
}
