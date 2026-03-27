<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tipe');
            $table->string('subtitle')->nullable()->default('Elegant & Modern');
            $table->string('luas_unit');
            $table->string('kapasitas')->nullable();
            $table->string('tower')->nullable();
            $table->string('view')->nullable();
            $table->string('foto_card')->nullable();
            $table->string('foto_3d')->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('deskripsi_singkat')->nullable();
            $table->json('fasilitas')->nullable();
            $table->json('galeri_foto')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};