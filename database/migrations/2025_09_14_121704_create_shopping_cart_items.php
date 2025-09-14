<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('shopping_cart_items', function (Blueprint $table) {
        $table->id();
        $table->foreignId('shopping_cart_id')->constrained('shopping_carts')->onDelete('cascade'); // Cascade delete when shopping cart is deleted
        $table->foreignId('product_item_id')->constrained('product_items')->onDelete('cascade'); // Cascade delete when product item is deleted
        $table->integer('quantity');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopping_cart_items');
    }
};
