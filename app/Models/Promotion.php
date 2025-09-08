<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'discount_rate', 'start_date', 'end_date'];


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
