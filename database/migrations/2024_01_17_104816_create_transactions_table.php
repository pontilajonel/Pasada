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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('student_userid')->unsigned()->nullable(false);
            $table->bigInteger('driver_userid')->unsigned()->nullable(false);
            $table->bigInteger('loc_id')->unsigned()->nullable(false);
            $table->text('pickup')->nullable(false);
            $table->integer('payment')->nullable()->default(null);
            $table->integer('passengernumber')->nullable(false);
            $table->enum('status', ['waiting', 'approved', 'done', 'canceled'])->default('waiting');
            $table->timestamps();

            $table->foreign('student_userid')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('driver_userid')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('loc_id')->references('id')->on('locations')->onDelete('restrict')->onUpdate('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
