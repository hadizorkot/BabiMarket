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
    Schema::create('product_items', function (Blueprint $table) {
        $table->id();
        $table->string('sku')->unique(); // SKU should be unique for each product item
        $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Cascade delete when product is deleted
        $table->integer('qty_in_stock');
        $table->decimal('price', 10, 2);
        $table->string('product_image')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_items');
    }
};
