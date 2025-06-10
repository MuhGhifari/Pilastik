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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collector_id')->constrained('users')->onDelete('cascade'); 
            $table->foreignId('trash_bin_id')->constrained('trash_bins')->onDelete('cascade'); 
            $table->time('scheduled_time'); 
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade'); 
            $table->foreignId('updated_by')->constrained('users')->onDelete('cascade')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
