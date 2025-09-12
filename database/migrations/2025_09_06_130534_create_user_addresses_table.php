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
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')  // Foreign key for user_id
                ->constrained('users')  // Reference to the users table
                ->onDelete('cascade');  // Cascade delete when a user is deleted

            $table->foreignId('address_id')  // Foreign key for address_id
                ->constrained('addresses')  // Reference to the addresses table
                ->onDelete('cascade');  // Cascade delete when an address is deleted

            $table->boolean('is_default')->default(false);  // Default address flag
            $table->timestamps();  // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_addresses');
    }
};
