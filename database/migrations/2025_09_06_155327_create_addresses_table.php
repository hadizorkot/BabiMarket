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
    Schema::create('addresses', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('unit_number')->nullable(); // Unit number if applicable
        $table->string('street_number');
        $table->string('address_line1');
        $table->string('address_line2')->nullable();
        $table->string('city');
        $table->string('region')->nullable();
        $table->string('postal_code');
        $table->foreignId('country_id')->constrained()->onDelete('cascade');
        $table->boolean('is_default')->default(false);
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('addresses');
}

};
