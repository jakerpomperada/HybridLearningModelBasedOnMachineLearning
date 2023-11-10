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
        Schema::create('student_exam_assessment_questions', function (Blueprint $table) {
	        $table->uuid('id')->primary();
	        $table->uuid('eacategory_id')->index();
	        $table->string('question');
	        
	        $table->timestamps();
	        
	        $table->foreign('eacategory_id')
		        ->references('id')
		        ->on('student_exam_assessment_categories')
		        ->onUpdate('CASCADE')
		        ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_exam_assessment_questions');
    }
};
