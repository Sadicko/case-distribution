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
        Schema::table('dockets', function (Blueprint $table) {
            $table->boolean('reassignment_initiated')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dockets', function (Blueprint $table) {
            $table->dropColumn(['reassignment_initiated']);
        });
    }
};
