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
        Schema::create('student_admissions', function (Blueprint $table) {
            $table->uuid('id')->primary();
	        $table->uuid('academic_term_id')->index();
	        $table->uuid('student_id')->index();
	        $table->uuid('course_id')->index();
	        $table->uuid('year_level');
	        $table->uuid('section');
			$table->timestamps();
	        
	        $table->foreign('academic_term_id')
		        ->references('id')
		        ->on('academic_terms')
		        ->onUpdate('CASCADE')
		        ->onDelete('CASCADE');
	        
	        $table->foreign('student_id')
		        ->references('id')
		        ->on('students')
		        ->onUpdate('CASCADE')
		        ->onDelete('CASCADE');
	        
	        $table->foreign('course_id')
		        ->references('id')
		        ->on('courses')
		        ->onUpdate('CASCADE')
		        ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_admissions');
    }
};
