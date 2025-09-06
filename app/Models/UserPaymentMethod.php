<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPaymentMethod extends Model
{
    use HasFactory;

    // UserPaymentMethod belongs to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // UserPaymentMethod belongs to PaymentType
    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }
}
