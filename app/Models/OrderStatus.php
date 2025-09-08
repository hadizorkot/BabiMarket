<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    protected $fillable = ['order_status'];
    

    // OrderStatus has many ShopOrders
    public function shopOrders()
    {
        return $this->hasMany(ShopOrder::class);
    }
}
