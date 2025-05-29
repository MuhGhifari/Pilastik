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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pickup_log_id')->constrained('pickup_logs')->onDelete('cascade'); // Foreign key to pickup_logs
            $table->unsignedTinyInteger('score'); // Rating value from 1 to 5
            $table->text('comments')->nullable(); // Optional comments about the rating
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
