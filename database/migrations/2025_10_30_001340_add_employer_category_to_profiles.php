// database/migrations/xxxx_xx_xx_xxxxxx_add_employer_category_to_profiles.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            // Add category column (string enum); nullable for legacy rows
            $table->string('employer_category')->nullable()->after('company')->index();

            // Ensure employer can be null (for JobSeeker/Entrepreneurship)
            $table->unsignedBigInteger('employer')->nullable()->change();

            // Optional FK (only if not already present)
            $table->foreign('employer')->references('id')->on('employers')->nullOnDelete();
        });

        // Optional backfill: if employer set but category null, assume private sector
        // DB::statement("UPDATE profiles SET employer_category = 'private_sector' WHERE employer IS NOT NULL AND employer_category IS NULL");
    }

    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            // Drop FK if you added it above
            $table->dropForeign(['employer']);
            $table->dropColumn('employer_category');
        });
    }
};
