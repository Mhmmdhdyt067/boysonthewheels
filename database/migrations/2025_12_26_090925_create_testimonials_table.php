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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('buyer_name'); // Nama Pembeli
            $table->text('message')->nullable(); // Kesan/Pesan
            $table->string('car_purchased')->nullable(); // Mobil apa yang dibeli
            $table->string('image_path'); // Foto serah terima
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
