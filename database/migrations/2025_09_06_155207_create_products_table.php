<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->foreignId('category_id')->constrained('product_categories')->onDelete('cascade');
        $table->string('name');
        $table->text('description');
        $table->string('product_image')->nullable(); // Store the image URL/path
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('products');
}

};
