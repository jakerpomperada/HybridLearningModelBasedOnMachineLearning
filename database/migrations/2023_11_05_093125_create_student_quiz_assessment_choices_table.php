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
        Schema::create('student_quiz_assessment_choices', function (Blueprint $table) {
	        $table->uuid('id')->primary();
	        $table->uuid('sqaquestion_id')->index();
			$table->integer('order');
	        $table->string('choice');
			$table->boolean('is_correct');
			
	        
	        $table->timestamps();
	        
	        $table->foreign('sqaquestion_id', 'sqaq_id')
		        ->references('id')
		        ->on('student_quiz_assessment_questions')
		        ->onUpdate('CASCADE')
		        ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_quiz_assessment_choices');
    }
};
