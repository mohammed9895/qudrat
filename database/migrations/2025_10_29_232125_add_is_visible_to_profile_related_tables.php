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
        // Add to educations
        Schema::table('educations', function (Blueprint $table) {
            $table->boolean('is_visible')->default(true)->after('graduated');
        });

        // Add to experiences
        Schema::table('experiences', function (Blueprint $table) {
            $table->boolean('is_visible')->default(false)->after('description');
        });

        // Add to achievements
        Schema::table('achievements', function (Blueprint $table) {
            $table->boolean('is_visible')->default(false)->after('achievement_file');
        });

        // Add to courses
        Schema::table('courses', function (Blueprint $table) {
            $table->boolean('is_visible')->default(false)->after('description');
        });

        // Add to certificates
        Schema::table('certificates', function (Blueprint $table) {
            $table->boolean('is_visible')->default(false)->after('certificate_file');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profile_related_tables', function (Blueprint $table) {
            //
        });
    }
};
