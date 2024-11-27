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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Profile::class)->constrained()->onDelete('cascade'); // Foreign key
            $table->string('title'); // Name of the course
            $table->string('organization'); // Organization providing the course
            $table->date('start_date')->nullable(); // Start date of the course
            $table->date('end_date')->nullable(); // End date of the course
            $table->string('certificate_file')->nullable(); // Optional file (certificate of completion)
            $table->text('description')->nullable(); // Additional details about the course
            $table->integer('sort')->default(0); // Sort order
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
