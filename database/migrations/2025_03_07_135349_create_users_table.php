<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('UID'); // Primary Key
            $table->string('role')->default('user');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('username')->unique();
            $table->integer('age')->nullable();
            $table->string('gender')->nullable();
            $table->timestamp('date_joined')->useCurrent();
            $table->string('profile_picture')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
?>