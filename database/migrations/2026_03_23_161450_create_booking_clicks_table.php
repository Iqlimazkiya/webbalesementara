<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('booking_clicks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->nullable()->constrained()->nullOnDelete();
            $table->string('unit_nama')->nullable();
            $table->date('click_date');
            $table->integer('month');
            $table->integer('year');
            $table->timestamps();
            $table->index('click_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_clicks');
    }
};