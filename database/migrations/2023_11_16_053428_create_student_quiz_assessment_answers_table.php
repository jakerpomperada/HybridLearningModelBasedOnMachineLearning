<?php
	
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;
	
	return new class extends Migration {
		/**
		 * Run the migrations.
		 */
		public function up(): void
		{
			Schema::create('quiz_assessment_answers', function (Blueprint $table) {
				$table->uuid('id')->primary();
				$table->uuid('quiz_assessment_question_id')->index();
				$table->uuid('quiz_assessment_choice_id')->index();
				$table->uuid('admission_id')->index();
				
				$table->foreign('quiz_assessment_question_id','qaq_id')
					->references('id')
					->on('student_quiz_assessment_questions')
					->onUpdate('CASCADE')
					->onDelete('CASCADE');
				
				$table->foreign('quiz_assessment_choice_id', 'qac_id')
					->references('id')
					->on('student_quiz_assessment_choices')
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
			Schema::dropIfExists('student_quiz_assessment_answers');
		}
	};
