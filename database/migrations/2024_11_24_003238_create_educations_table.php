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
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Profile::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\School::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\EducationType::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\FieldOfStudy::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\FieldOfStudy::class, 'field_of_study_child_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('grade')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('graduated')->default(false);
            $table->integer('sort')->nullable();
            $table->morphs('addable');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education');
    }
};
