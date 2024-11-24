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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->constrained()->cascadeOnDelete();
            $table->string('fullname')->nullable();
            $table->string('username')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('avatar')->nullable();
            $table->string('position')->nullable();
            $table->text('bio')->nullable();
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->string('video')->nullable();

            $table->foreignIdFor(\App\Models\Country::class)->nullable()->constrained()->nullOnDelete();
           $table->foreignIdFor(\App\Models\Province::class)->nullable()->constrained()->nullOnDelete();
           $table->foreignIdFor(\App\Models\State::class)->nullable()->constrained()->nullOnDelete();

            $table->string('address')->nullable();
            $table->string('company')->nullable();
            $table->string('website')->nullable();

            $table->json('skills')->nullable();
            $table->json('languages')->nullable();
            $table->json('tools')->nullable();
            $table->json('categories')->nullable();
            $table->json('interested')->nullable();

            $table->string('social_facebook')->nullable();
            $table->string('social_x')->nullable();
            $table->string('social_linkedin')->nullable();
            $table->string('social_github')->nullable();
            $table->string('social_stackoverflow')->nullable();
            $table->string('social_youtube')->nullable();
            $table->string('social_instagram')->nullable();
            $table->string('social_pinterest')->nullable();
            $table->string('social_whatsapp')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
