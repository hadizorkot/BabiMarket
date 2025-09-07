<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'cost'];
    

    // ShippingMethod has many ShopOrders
    public function shopOrders()
    {
        return $this->hasMany(ShopOrder::class);
    }
}
