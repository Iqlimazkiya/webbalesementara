<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('layanan_c_o_s', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('foto_hero')->nullable();
            $table->json('foto_slide')->nullable();
            $table->json('foto_galeri')->nullable();
            $table->json('tarif_cleaning')->nullable();
            $table->json('tarif_cuci')->nullable();
            $table->json('tarif_tambahan')->nullable();
            $table->json('tarif_berkala')->nullable();
            $table->json('ketentuan')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('layanan_c_o_s');
    }
};