<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_number',
        'street_number',
        'address_line1',
        'address_line2',
        'city',
        'region',
        'postal_code',
        'country_id',
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
