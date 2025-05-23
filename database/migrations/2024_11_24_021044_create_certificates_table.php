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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Profile::class)->constrained()->onDelete('cascade'); // Foreign key
            $table->text('title'); // Name or title of the certificate
            $table->text('organization'); // Issuing organization
            $table->date('issued_date'); // Date of issue
            $table->date('expiry_date')->nullable(); // Expiry date (if applicable)
            $table->text('certificate_file')->nullable(); // Path to uploaded certificate file (e.g., PDF, image)
            $table->integer('sort')->default(0); // Sort order
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
        Schema::dropIfExists('certificates');
    }
};
