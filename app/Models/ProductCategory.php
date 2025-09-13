<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = ['category_name','parent_category_id'];

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
    // ProductCategory may have a parent category
    public function parentCategory()
{
    return $this->belongsTo(ProductCategory::class, 'parent_category_id')->onDelete('cascade');
}

public function childCategories()
{
    return $this->hasMany(ProductCategory::class, 'parent_category_id')->onDelete('cascade');
}


    
}
