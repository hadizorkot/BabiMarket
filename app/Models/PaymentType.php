<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    use HasFactory;

    protected $fillable = ['value'];


    // PaymentType has many UserPaymentMethods
    public function userPaymentMethods()
    {
        return $this->hasMany(UserPaymentMethod::class);
    }
}
