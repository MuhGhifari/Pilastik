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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('license_plate')->unique(); // Unique license plate number
            $table->string('vehicle_type'); // Type of vehicle, e.g., 'truck', 'van'
            $table->string('model'); // Model of the vehicle
            $table->string('status')->default('available'); // Status of the vehicle, e.g., 'available', 'in_use', 'maintenance'
            $table->float('capacity')->default(0); // Capacity of the vehicle in kg
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
