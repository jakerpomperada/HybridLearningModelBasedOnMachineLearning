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
        Schema::create('student_quiz_assessment_questions', function (Blueprint $table) {
	        $table->uuid('id')->primary();
	        $table->uuid('qacategory_id')->index();
	        $table->string('question');
	        
	        $table->timestamps();
	        
	        $table->foreign('qacategory_id')
		        ->references('id')
		        ->on('student_quiz_assessment_categories')
		        ->onUpdate('CASCADE')
		        ->onDelete('CASCADE');
			
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_quiz_assessment_questions');
    }
};
