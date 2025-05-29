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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // Type of notification (e.g., 'pickup', 'drop_off', 'reminder')
            $table->text('notifiable_type'); // Polymorphic type for the model being notified (e.g., 'App\Models\PickupLog')
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Polymorphic ID for the model being notified
            $table->text('data'); // JSON data for the notification content
            $table->boolean('read')->default(false); // Whether the notification has been read
            $table->timestamp('read_at')->nullable(); // Timestamp when the notification was read
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
