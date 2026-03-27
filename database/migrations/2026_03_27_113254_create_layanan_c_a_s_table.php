<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('layanan_c_a_s', function (Blueprint $table) {
        $table->id();

        $table->string('hero_badge')->default('Commercial Area');
        $table->string('hero_title')->default('Balehinggil');
        $table->string('hero_subtitle')->default('Creative & Business Hub');
        $table->string('hero_tagline')->default('One Space, Unlimited Possibilities');
        $table->text('hero_description')->nullable();

        $table->string('whatsapp_number')->default('6282334466773');
        $table->string('cta_title')->default('Wujudkan Event');
        $table->string('cta_subtitle')->default('Impian Anda');
        $table->text('cta_description')->nullable();

        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}
public function down(): void
{
    Schema::dropIfExists('layanan_c_a_s');
}
};