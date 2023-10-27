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
        Schema::create('student_attendances', function (Blueprint $table) {
	        $table->uuid('id')->primary();
			$table->date('date');
			$table->uuid('teaching_load_id')->index();
	        $table->uuid('student_admission_id')->index();
	        $table->uuid('status');
	        $table->string('note')->nullable();
			
            $table->timestamps();
	        
	        
	       
	        $table->foreign('teaching_load_id')
		        ->references('id')
		        ->on('teaching_loads')
		        ->onUpdate('CASCADE')
		        ->onDelete('CASCADE');
	        
	        $table->foreign('student_admission_id')
		        ->references('id')
		        ->on('student_admissions')
		        ->onUpdate('CASCADE')
		        ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_attendances');
    }
};
