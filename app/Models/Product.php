<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Product belongs to ProductCategory
    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    // Product has many ProductItems
    public function productItems()
    {
        return $this->hasMany(ProductItem::class);
    }
}
