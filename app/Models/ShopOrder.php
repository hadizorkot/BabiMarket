<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopOrder extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'payment_method_id', 'shipping_method_id', 'order_status_id', 'total_amount', 'order_date'];

    // ShopOrder belongs to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ShopOrder belongs to PaymentMethod
    public function paymentMethod()
    {
        return $this->belongsTo(UserPaymentMethod::class);
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
