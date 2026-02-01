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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lesson_id')->index(); // Index for performance
            $table->text('question');
            $table->json('options'); // Key-value pairs: {"1": "A", "2": "B"...}
            $table->integer('answer'); // Key of the correct option (e.g. 1)
            $table->timestamps();

            // Optional: Foreign key constraint (if lessons table uses BigIncrements id)
            // $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
