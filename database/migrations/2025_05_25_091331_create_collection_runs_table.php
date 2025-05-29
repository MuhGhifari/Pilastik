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
            $table->foreignId('collector_id')->constrained('users')->onDelete('cascade'); // Foreign key to users (collector)
            $table->foreignId('vehicle_id')->constrained('vehicles')->onDelete('cascade'); // Foreign key to vehicles
            $table->timestamp('start_time')->default(now()); // Start time of the collection run
            $table->timestamp('end_time')->nullable(); // End time of the collection run
            $table->string('status')->default('in_progress'); // Status of the collection run (e.g., 'in_progress', 'completed', 'cancelled')
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
