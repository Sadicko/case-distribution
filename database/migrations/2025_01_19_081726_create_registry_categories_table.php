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
        Schema::create('registry_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registry_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->unsignedBigInteger('created_by')->nullable()->comment('who assigned or unassigned');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registry_categories');
    }
};
