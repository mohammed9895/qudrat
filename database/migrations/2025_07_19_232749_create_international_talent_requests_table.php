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
        Schema::create('international_talent_requests', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('dob')->nullable();
            $table->string('country')->nullable();
            $table->text('bio');
            $table->string('cv')->nullable();
            $table->text('portfolio')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('github')->nullable();
            $table->string('twitter')->nullable();
            $table->string('website')->nullable();
            $table->string('status')->default('pending'); // e.g., pending, approved, rejected
            $table->string('message')->nullable();
            $table->string('attachments')->nullable(); // Store file paths or URLs for attachments
            $table->text('reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('international_talent_requests');
    }
};
