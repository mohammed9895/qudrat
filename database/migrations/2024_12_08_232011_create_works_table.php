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
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_category_id')->constrained('work_categories')->cascadeOnDelete();
            $table->foreignId('profile_id')->constrained('profiles')->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('images')->nullable();
            $table->string('cover')->nullable();
            $table->text('video')->nullable();
            $table->text('attachments')->nullable();
            $table->text('attachment_file_names')->nullable();
            $table->string('link')->nullable();
            $table->integer('status')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('works');
    }
};
