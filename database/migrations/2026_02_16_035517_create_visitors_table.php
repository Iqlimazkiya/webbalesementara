<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->date('visit_date')->nullable();
            $table->integer('hour')->nullable();
            $table->integer('day_of_week')->nullable();
            $table->integer('week_of_year')->nullable();
            $table->integer('month')->nullable();
            $table->integer('year')->nullable();
            $table->integer('count')->default(1);
            $table->timestamps();
            $table->index('visit_date');
            $table->index('year');
            $table->index('month');
            $table->index('week_of_year');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
