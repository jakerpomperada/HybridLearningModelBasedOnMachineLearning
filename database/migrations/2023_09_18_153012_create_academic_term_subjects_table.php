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
        Schema::create('academic_term_subjects', function (Blueprint $table) {
            $table->uuid('academic_term_id')->primary();
            $table->uuid('course_id')->index();
            $table->uuid('subject_id')->index();
            $table->timestamps();

            $table->foreign('academic_term_id')
                ->references('id')
                ->on('academic_terms')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table->foreign('course_id')
                ->references('id')
                ->on('courses')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table->foreign('subject_id')
                ->references('id')
                ->on('subjects')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_term_subjects');
    }
};
