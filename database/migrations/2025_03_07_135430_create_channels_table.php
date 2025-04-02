<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('channels', function (Blueprint $table) {
            $table->id('CID'); // Primary Key
            $table->foreignId('UID')->constrained('users', 'UID')->onDelete('cascade'); // Foreign Key
            $table->string('name');
            $table->integer('sub_count')->default(0);
            $table->timestamp('date_created')->useCurrent();
            $table->text('description')->nullable();
            $table->boolean('is_creator')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('channels');
    }
};
