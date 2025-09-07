<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    // The attributes that are mass assignable
    protected $fillable = [
        'name', 
        'email_address', 
        'phone_number', 
        'password',
    ];

    // The attributes that should be hidden for serialization
    protected $hidden = [
        'password', 
        'remember_token',
    ];

    // User has many orders
    public function orders()
    {
        return $this->hasMany(ShopOrder::class);
    }

    // User has many reviews
    public function reviews()
    {
        return $this->hasMany(UserReview::class);
    }

    // User has many addresses
    public function addresses()
    {
        return $this->hasMany(UserAddress::class);
    }

    // User has many payment methods
    public function paymentMethods()
    {
        return $this->hasMany(UserPaymentMethod::class);
    }

    // User has many shopping carts
    public function shoppingCarts()
    {
        return $this->hasMany(ShoppingCart::class);
    }
}
