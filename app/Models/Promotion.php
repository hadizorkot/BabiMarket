<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    // Promotion has many Products through PromotionCategory
    public function products()
    {
        return $this->belongsToMany(Product::class, 'promotion_categories');
    }

    // Promotion has many ProductCategories
    public function productCategories()
    {
        return $this->belongsToMany(ProductCategory::class, 'promotion_categories');
    }
}
