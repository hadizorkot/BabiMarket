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
    Schema::create('shipping_methods', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->decimal('price', 10, 2); // Shipping cost
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('shipping_methods');
}

};
