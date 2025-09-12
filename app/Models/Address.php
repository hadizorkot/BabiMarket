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
        'country_name',
        'address_line1',
        'address_line2',
        'city',
        'region',
        'postal_code'
    ];

    // Change the relationship to belongsToMany
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_addresses', 'address_id', 'user_id')
                    ->withPivot('is_default')  // If needed
                    ->withTimestamps();
    }
}

