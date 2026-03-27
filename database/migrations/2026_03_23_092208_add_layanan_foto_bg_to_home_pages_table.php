<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('homepage', function (Blueprint $table) {
            $table->string('layanan_foto_bg')->nullable()->after('layanan_buttons');
        });
    }

    public function down(): void
    {
        Schema::table('homepages', function (Blueprint $table) {
            $table->dropColumn('layanan_foto_bg');
        });
    }
};