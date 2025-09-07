<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];
    

    // ProductCategory has many Products
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // ProductCategory has many Promotions through PromotionCategory
    public function promotions()
    {
        return $this->belongsToMany(Promotion::class, 'promotion_categories');
    }
}
