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
            $table->string('suit_number');
            $table->longText('case_title');
            $table->foreignId('category_id')->constrained();
            $table->foreignId('court_id')->constrained();
            $table->foreignId('location_id')->constrained();
            $table->string('priority_level')->default('normal')->comment('normal & urgent');
            $table->string('status')->default('Assigned')->comment('Assigned & Closed');
            $table->boolean('is_assigned')->default(0);
            $table->dateTime('date_filed')->nullable();
            $table->dateTime('assigned_date')->nullable();
            $table->boolean('exported')->default(0);
            $table->dateTime('exported_at')->nullable();
            $table->dateTime('disposed_at')->nullable();
            $table->unsignedBigInteger('disposed_by')->nullable();
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
