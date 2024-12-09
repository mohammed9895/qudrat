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
        Schema::table('profiles', function (Blueprint $table) {
            $table->integer('public_profile')->after('social_whatsapp')->default(1);
            $table->integer('can_send_message')->after('public_profile')->default(1);
            $table->integer('show_email')->after('can_send_message')->default(1);
            $table->integer('show_phone')->after('show_email')->default(1);
            $table->integer('show_location')->after('show_phone')->default(1);
            $table->integer('show_social_links')->after('show_location')->default(1);
            $table->integer('show_rating')->after('show_social_links')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profile', function (Blueprint $table) {
            //
        });
    }
};
