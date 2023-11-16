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
        Schema::create('exam_assessment_answers', function (Blueprint $table) {
	        $table->uuid('id')->primary();
	        $table->uuid('exam_assessment_question_id')->index();
	        $table->uuid('exam_assessment_choice_id')->index();
	        $table->uuid('admission_id')->index();
	        
	        $table->foreign('exam_assessment_question_id','qae_id')
		        ->references('id')
		        ->on('student_exam_assessment_questions')
		        ->onUpdate('CASCADE')
		        ->onDelete('CASCADE');
	        
	        $table->foreign('exam_assessment_choice_id', 'xac_id')
		        ->references('id')
		        ->on('student_exam_assessment_choices')
		        ->onUpdate('CASCADE')
		        ->onDelete('CASCADE');
	        
	        $table->foreign('admission_id')
		        ->references('id')
		        ->on('admissions')
		        ->onUpdate('CASCADE')
		        ->onDelete('CASCADE');
	        
	        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_assessment_answers');
    }
};
