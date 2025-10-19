<?php

use App\Models\Profile;
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
        Schema::create('innovators_and_researchers_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Profile::class)->constrained()->cascadeOnDelete();
            $table->text('reason');
            $table->string('category_id')->nullable(); // Category of the request
            $table->text('attachments')->nullable(); // JSON or text field to store file paths or URLs
            $table->text('message')->nullable(); // Additional message from the user
            $table->integer('status')->default(0); // pending, approved, rejected
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('innovators_and_researchers_requests');
    }
};
