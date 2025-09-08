<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PromotionCategory extends Model
{
    protected $fillable = ['category_id', 'promotion_id'];



    use HasFactory;    // PromotionCategory belongs to ProductCategory
    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');

    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');  
    }

    // PromotionCategory belongs to Promotion
    public function promotion(){
        return $this->belongsTo(Promotion::class);  
    }



}
