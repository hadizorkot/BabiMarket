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
        Schema::create('shop_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->timestamp('order_date');
            $table->foreignId('payment_method_id')->constrained('user_payment_methods');
            $table->foreignId('shipping_address_id')->constrained('addresses');
            $table->foreignId('shipping_method_id')->constrained('shipping_methods');
            $table->decimal('order_total');
            $table->foreignId('order_status')->constrained('order_statuses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_orders');
    }
};
