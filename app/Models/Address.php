<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'country_id',
        'address_line1',
        'address_line2',
        'city',
        'state',
        'postal_code',
        'is_default',
    ];

    // Address belongs to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Address belongs to Country
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
