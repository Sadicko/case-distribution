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
        Schema::create('dockets', function (Blueprint $table) {
            $table->string('slug');
            $table->string('suit_no');
            $table->longText('case_title');
            $table->foreignId('category_id')->constrained();
            $table->string('status');
            $table->boolean('is_assigned')->default(0);
            $table->dateTime('assigned_date')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('court_id')->nullable();
            $table->boolean('exported')->default(0);
            $table->dateTime('exported_at')->nullable();
            $table->dateTime('disposed_at')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dockets');
    }
};
