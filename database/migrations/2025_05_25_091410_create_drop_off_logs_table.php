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
        Schema::create('drop_off_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collection_run_id')->constrained('collection_runs')->onDelete('cascade');
            $table->foreignId('drop_off_location_id')->constrained('drop_off_locations')->onDelete('cascade');
            $table->float('weight');
            $table->timestamp('drop_off_time')->default(now());
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drop_off_logs');
    }
};
