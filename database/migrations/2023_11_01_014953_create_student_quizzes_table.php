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
        Schema::create('student_quizzes', function (Blueprint $table) {
	        $table->uuid('id')->primary();
	        $table->uuid('student_quiz_category_id')->index();
	        $table->uuid('student_admission_id')->index();
	        $table->integer('score');
	        
	        $table->timestamps();
	        
	        $table->foreign('student_quiz_category_id')
		        ->references('id')
		        ->on('student_quiz_categories')
		        ->onUpdate('CASCADE')
		        ->onDelete('CASCADE');
	        
	        $table->foreign('student_admission_id')
		        ->references('id')
		        ->on('admissions')
		        ->onUpdate('CASCADE')
		        ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_quizzes');
    }
};
