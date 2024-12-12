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
        Schema::create('entity_certificate_presets', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Entity::class)->constrained()->cascadeOnDelete();
            $table->text('name');
            $table->text('description')->nullable();
            $table->text('file')->nullable();
            $table->integer('status')->default(1);
            $table->foreignIdFor(\App\Models\User::class, 'created_by')->constrained()->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entity_certificate_presets');
    }
};
