<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'street_number',
        'address_line1',
        'address_line2',
        'city',
        'region',
        'postal_code',
        'country_id',
        'is_default',
    ];

    // UserAddress belongs to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // UserAddress belongs to Country
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
