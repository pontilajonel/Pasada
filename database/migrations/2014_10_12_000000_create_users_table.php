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
        Schema::create('users', function (Blueprint $table) {
            $table->id('id');
            $table->string('name',20);
            $table->string('email',20)->unique();
            $table->string('password');
            $table->string('phonenumber',15);
            $table->string('accounttype',8);
            $table->string('image_path')->nullable();
            $table->string('sex',7);
            $table->enum('status', ['available', 'not available'])->default('not available');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
