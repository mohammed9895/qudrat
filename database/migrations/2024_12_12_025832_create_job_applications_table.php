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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Entity::class);
            $table->text('title');
            $table->text('position');
            $table->text('description');
            $table->foreignIdFor(\App\Models\JobDepartment::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Province::class)->constrained()->cascadeOnDelete();
            $table->string('salary');
            $table->foreignIdFor(\App\Models\EmploymentType::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\EducationType::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\ExperienceLevel::class)->constrained()->cascadeOnDelete();
            $table->integer('status')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('category_job_application', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Category::class);
            $table->foreignIdFor(\App\Models\JobApplication::class);
            $table->timestamps();
        });

        Schema::create('job_application_skill', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Skill::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\JobApplication::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('job_application_tool', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\JobApplication::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Tool::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
        Schema::dropIfExists('category_job');
        Schema::dropIfExists('job_skills');
        Schema::dropIfExists('job_tool');
    }
};
