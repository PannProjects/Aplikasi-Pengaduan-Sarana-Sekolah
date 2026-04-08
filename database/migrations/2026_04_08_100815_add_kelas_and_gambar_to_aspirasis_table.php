<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('aspirasis', function (Blueprint $table) {
            $table->string('kelas', 20)->nullable()->after('nis');
            $table->string('gambar')->nullable()->after('ket_aspirasi');
        });
    }

    public function down(): void
    {
        Schema::table('aspirasis', function (Blueprint $table) {
            $table->dropColumn(['kelas', 'gambar']);
        });
    }
};
