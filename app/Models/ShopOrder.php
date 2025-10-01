<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopOrder extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'order_date',  
    'payment_method_id', 'shipping_address_id', 'shipping_method_id', 'order_total', 'order_status_id'];

    // ShopOrder belongs to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ShopOrder belongs to PaymentMethod
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    // ShopOrder belongs to ShippingMethod
    public function shippingMethod()
    {
        return $this->belongsTo(ShippingMethod::class);
    }

    // ShopOrder belongs to OrderStatus
    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    // ShopOrder has many OrderLines
    public function orderLines()
    {
        return $this->hasMany(OrderLine::class);
    }
}
