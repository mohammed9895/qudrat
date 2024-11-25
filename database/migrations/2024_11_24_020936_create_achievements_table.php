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
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Profile::class)->constrained()->onDelete('cascade'); // Foreign key
            $table->string('title'); // Title of the achievement
            $table->text('description')->nullable(); // Description of the achievement
            $table->date('date'); // Date of the achievement
            $table->string('category')->nullable(); // Category of the achievement
            $table->string('achievement_file')->nullable(); // Path to the achievement image or certificate
            $table->integer('sort')->default(0); // Sort order
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achievements');
    }
};
