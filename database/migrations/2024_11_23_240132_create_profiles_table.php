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
            $table->foreignIdFor(\App\Models\Category::class)->nullable()->constrained()->nullOnDelete();

            $table->text('fullname')->nullable();
            $table->text('username')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('avatar')->nullable();
            $table->text('position')->nullable();
            $table->text('bio')->nullable();
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->string('video')->nullable();
            $table->string('cv')->nullable();
            $table->foreignIdFor(\App\Models\ExperienceLevel::class)->nullable()->constrained()->nullOnDelete();

            $table->foreignIdFor(\App\Models\Country::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(\App\Models\Nationality::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(\App\Models\Province::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(\App\Models\State::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(\App\Models\City::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(\App\Models\State::class, 'permanent_residence_state_id')->nullable()->constrained()->nullOnDelete();

            $table->integer('health_status')->nullable();
            $table->foreignIdFor(\App\Models\Disability::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(\App\Models\EducationType::class)->nullable()->constrained()->nullOnDelete();

            $table->text('address')->nullable();
            $table->text('company')->nullable();
            $table->text('website')->nullable();


            $table->string('social_facebook')->nullable();
            $table->string('social_x')->nullable();
            $table->string('social_linkedin')->nullable();
            $table->string('social_github')->nullable();
            $table->string('social_stackoverflow')->nullable();
            $table->string('social_youtube')->nullable();
            $table->string('social_instagram')->nullable();
            $table->string('social_pinterest')->nullable();
            $table->string('social_whatsapp')->nullable();

            $table->integer('public_profile')->default(1);
            $table->integer('can_send_message')->default(1);
            $table->integer('show_email')->default(1);
            $table->integer('show_phone')->default(1);
            $table->integer('show_location')->default(1);
            $table->integer('show_social_links')->default(1);
            $table->integer('show_rating')->default(1);

            $table->boolean('status')->default(true);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('category_profile', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('profile_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('profiles');
        Schema::enableForeignKeyConstraints();
    }
};
