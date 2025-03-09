<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('comment_rates', function (Blueprint $table) {
            $table->id('CRID'); // Primary Key
            $table->foreignId('UID')->constrained('users','UID')->onDelete('cascade'); // Foreign Key
            $table->foreignId('VidID')->constrained('videos','VidID')->onDelete('cascade'); // Foreign Key
            $table->text('comment_text')->nullable(); 
            $table->integer('rating')->default(0); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('comment_rates');
    }
};
