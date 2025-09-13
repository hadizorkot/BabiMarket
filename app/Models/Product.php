<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Mass assignable fields
    protected $fillable = ['category_id', 'name', 'description', 'product_image'];

    // Relationship: Product belongs to ProductCategory
    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    // Relationship: Product has many ProductItems
    public function productItems()
    {
        return $this->hasMany(ProductItem::class, 'product_id')->onDelete('cascade'); // Cascade delete on product deletion
    }
    
    // Define the unique validation logic at the model level (Optional, if you need to do checks in the model itself)
    public static function checkDuplicate($category_id, $name, $description, $exclude_id = null)
    {
        $query = self::where('category_id', $category_id)
                     ->where('name', $name)
                     ->where('description', $description);

        // Exclude the current product if updating
        if ($exclude_id) {
            $query->where('id', '!=', $exclude_id);
        }

        return $query->exists(); // Returns true if a duplicate exists, false otherwise
    }
}

