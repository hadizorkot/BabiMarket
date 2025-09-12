<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'address_id',
        'is_default',
    ];

    // UserAddress belongs to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // UserAddress belongs to Address
    public function address()
    {
        return $this->belongsTo(Address::class);
    
    }
}
