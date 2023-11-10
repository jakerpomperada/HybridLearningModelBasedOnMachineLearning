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
        Schema::create('student_exam_assessment_choices', function (Blueprint $table) {
	        $table->uuid('id')->primary();
	        $table->uuid('seaquestion_id')->index();
	        $table->integer('order');
	        $table->string('choice');
	        $table->boolean('is_correct');
	        
	        
	        $table->timestamps();
	        
	        $table->foreign('seaquestion_id', 'seaq_id')
		        ->references('id')
		        ->on('student_exam_assessment_questions')
		        ->onUpdate('CASCADE')
		        ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_exam_assessment_choices');
    }
};
