<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('layanan_w_o_s', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('foto_carousel_1')->nullable();
            $table->string('foto_carousel_2')->nullable();
            $table->string('foto_carousel_3')->nullable();
            $table->string('foto_carousel_4')->nullable();
            $table->string('foto_slide_1')->nullable();
            $table->string('foto_slide_2')->nullable();
            $table->string('foto_slide_3')->nullable();
            $table->json('tarif_listrik')->nullable();
            $table->json('tarif_plumbing')->nullable();
            $table->json('tarif_umum')->nullable();
            $table->json('ketentuan')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('layanan_w_o_s');
    }
};