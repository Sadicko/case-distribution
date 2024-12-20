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
        Schema::create('court_judges', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->foreignId('court_id')->constrained();
            $table->foreignId('judge_id')->constrained();
            $table->timestamp('assigned_at')->comment('When the judge was assigned');
            $table->timestamp('unassigned_at')->nullable()->comment('When the judge was unassigned');
            $table->unsignedBigInteger('created_by')->nullable()->comment('who assigned or unassigned');
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('court_judges');
    }
};
