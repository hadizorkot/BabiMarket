<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code'];

    // Country has many UserAddresses
    public function userAddresses()
    {
        return $this->hasMany(UserAddress::class);
    }
}
