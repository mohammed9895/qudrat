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
        Schema::create('digital_library_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\DigitalLibraryCategory::class)->constrained('digital_library_categories')->cascadeOnDelete();
            $table->text('title')->nullable();
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->text('image')->nullable();
            $table->text('file')->nullable();
            $table->boolean('is_featured')->nullable();
            $table->integer('status')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('digital_library_posts');
    }
};
