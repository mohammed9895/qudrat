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
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->integer('user_type')->nullable();
            $table->integer('general_impression')->nullable();
            $table->integer('ease')->nullable();
            $table->integer('speed')->nullable();
            $table->integer('meet_your_needs')->nullable();
            $table->integer('clarity')->nullable();
            $table->text('comment')->nullable();
            $table->text('phone_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
