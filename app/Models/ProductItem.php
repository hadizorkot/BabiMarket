<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductItem extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'sku', 'stock', 'price'];  

    // ProductItem belongs to Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // ProductItem has many OrderLines
    public function orderLines()
    {
        return $this->hasMany(OrderLine::class);
    }
}
