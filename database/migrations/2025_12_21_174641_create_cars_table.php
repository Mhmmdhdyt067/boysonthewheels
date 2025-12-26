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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama Mobil
            $table->string('brand'); // Merek (Toyota, Honda, dll)
            $table->string('slug')->unique(); // Untuk SEO Friendly URL
            $table->year('year'); // Tahun
            $table->enum('transmission', ['Manual', 'Automatic']);
            $table->integer('mileage'); // KM
            $table->enum('body_type', ['City Car', 'Sedan', 'Mobil Keluarga', 'SUV']); // Model
            $table->enum('row_type', ['2 baris', '3 baris', 'Lebih dari 3 baris'])
                ->default('2 baris'); // Jumlah Baris
            $table->bigInteger('price'); // Harga Asli (bukan range)
            $table->bigInteger('installment')->default(0);
            $table->bigInteger('down_payment'); // DP Asli
            $table->text('description');
            $table->string('video_link')->nullable();
            $table->boolean('is_sold')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
