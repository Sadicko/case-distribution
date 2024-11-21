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
        Schema::create('courts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->nullable();
            $table->foreignId('registry_id')->nullable();
            $table->foreignId('courttype_id');
            $table->foreignId('location_id');
            $table->foreignId('region_id')->nullable();;
            $table->unsignedInteger('case_count')->nullable();
            $table->boolean('availability')->default(1);
            $table->unsignedBigInteger('created_by');
            $table->string('slug')->index();
            $table->string('status')->default('Published');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courts');
    }
};
