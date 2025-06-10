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
        Schema::create('collection_runs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collector_id')->constrained('users')->onDelete('cascade'); 
            $table->foreignId('vehicle_id')->constrained('vehicles')->onDelete('cascade'); 
            $table->time('start_time')->default(now()); 
            $table->time('end_time')->nullable(); 
            $table->string('status')->default('in_progress'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collection_runs');
    }
};
