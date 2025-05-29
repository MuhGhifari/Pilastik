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
        Schema::create('drop_off_locations', function (Blueprint $table) {
            $table->id();
            $table->string('location_id')->unique(); // Unique identifier for the drop-off location
            $table->string('name'); // Name of the drop-off location
            $table->string('address'); // Address of the drop-off location
            $table->float('latitude'); // Latitude coordinate
            $table->float('longitude'); // Longitude coordinate
            $table->string('status')->default('active'); // Status of the location, e.g., 'active', 'inactive'
            $table->text('description')->nullable(); // Optional description of the location
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade'); // User who created the location
            $table->foreignId('updated_by')->constrained('users')->onDelete('cascade'); // User who last updated the location
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drop_off_locations');
    }
};
