<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id('VidID'); // Primary Key
            $table->foreignId('CID')->constrained('channels', 'CID')->onDelete('cascade');
            $table->foreignId('UID')->constrained('users', 'UID')->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('video_path'); // Store the uploaded video path
            $table->string('thumbnail')->nullable(); // Store the thumbnail image path
            $table->integer('length'); // Video length in seconds
            $table->timestamp('upload_date')->useCurrent();
            $table->string('genre');
            $table->integer('view_count')->default(0);
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('videos');
    }
};
