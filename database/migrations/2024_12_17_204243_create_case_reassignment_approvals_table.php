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
        Schema::create('case_reassignment_approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('case_reassignment_id');
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->tinyInteger('step')->comment(' Approval step');
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_reassignment_approvals');
    }
};
