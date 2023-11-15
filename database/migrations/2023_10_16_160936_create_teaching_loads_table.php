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
        Schema::create('teaching_loads', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->uuid('teacher_id')->index();
			$table->uuid('subject_id')->index();
	        $table->uuid('academic_term_semester_id')->index();
			$table->string('year_level');
			$table->string('section');
			$table->string('semester');
			$table->string('course_id')->index();
            $table->timestamps();
	        
	        $table->foreign('teacher_id')
		        ->references('id')
		        ->on('teachers')
		        ->onUpdate('CASCADE')
		        ->onDelete('CASCADE');
	        
	        $table->foreign('subject_id')
		        ->references('id')
		        ->on('subjects')
		        ->onUpdate('CASCADE')
		        ->onDelete('CASCADE');
	        
	        $table->foreign('course_id')
		        ->references('id')
		        ->on('courses')
		        ->onUpdate('CASCADE')
		        ->onDelete('CASCADE');
	        
	        $table->foreign('academic_term_semester_id')
		        ->references('id')
		        ->on('academic_term_semesters')
		        ->onUpdate('CASCADE')
		        ->onDelete('CASCADE');
	        
	        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teaching_loads');
    }
};
