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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('SID')->constrained('users', 'UID')->onDelete('cascade'); // User who subscribes
            $table->foreignId('CID')->constrained('channels', 'CID')->onDelete('cascade');// User who owns the channel/video
            $table->timestamps();
    
            $table->unique(['SID', 'CID']); // Ensure each subscriber can only subscribe once to a creator
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
