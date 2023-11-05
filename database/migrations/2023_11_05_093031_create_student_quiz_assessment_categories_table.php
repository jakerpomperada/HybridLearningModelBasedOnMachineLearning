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
        Schema::create('student_quiz_assessment_categories', function (Blueprint $table) {
	        $table->uuid('id')->primary();
	        $table->dateTime('start_date');
	        $table->dateTime('end_date');
	        $table->uuid('teaching_load_id')->index();
	        $table->string('title');
			$table->char('status', 8);
	        $table->timestamps();
			
			
			$table->foreign('teaching_load_id')
		        ->references('id')
		        ->on('teaching_loads')
		        ->onUpdate('CASCADE')
		        ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_quiz_assessment_categories');
    }
};
