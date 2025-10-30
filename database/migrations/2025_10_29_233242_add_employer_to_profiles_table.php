<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            // New employer field (جهة العمل)
            $table->string('employer')->nullable()->after('company')->index();
        });

        // OPTIONAL: backfill employer from existing company values
        // DB::statement('UPDATE profiles SET employer = company WHERE employer IS NULL AND company IS NOT NULL');
    }

    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn('employer');
        });
    }
};
