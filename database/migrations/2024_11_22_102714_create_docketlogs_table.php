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
        Schema::create('docketlogs', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->foreignId('docket_id');
            $table->foreignId('user_id');
            $table->enum('activity', ['Created', 'Updated', 'Change', 'Added'])->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('docketlogs');
    }
};