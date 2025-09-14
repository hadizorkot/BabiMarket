<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductItem extends Model
{
    use HasFactory;

    protected $fillable = ['sku','product_id' , 'qty_in_stock', 'price' , 'product_image'];  

    // ProductItem belongs to Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id')->onDelete('cascade'); // Cascade delete on product deletion
    }

    // ProductItem has many OrderLines
    public function orderLines()
    {
        return $this->hasMany(OrderLine::class);
    }
}
