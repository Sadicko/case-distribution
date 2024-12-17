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
        Schema::create('case_reassignments', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->foreignId('docket_id');
            $table->string('suit_number');
            $table->string('case_title');
            $table->foreignId('category_id');
            $table->string('case_stage')->nullable();
            $table->foreignId('location_id');
            $table->longText('reason_for_manual_assignment');
            $table->unsignedBigInteger('submitted_by');
            $table->string('status')->default('pending')->comment('pending, approved, rejected');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_reassignments');
    }
};
