<?php
	
	namespace App\Repositories;
	
	use App\Models\StudentExamAssessmentCategory;
	use App\Models\StudentExamAssessmentQuestion;
	use App\Models\StudentExamCategory;
	use App\Models\StudentQuizAssessmentChoice;
	use App\Models\StudentQuizAssessmentQuestion;
	use Domain\Modules\Assessment\Entities\ExamAssessmentCategory;
	use Domain\Modules\Assessment\Repositories\IAssessmentRepository;
	use Domain\Modules\Teacher\Entities\ExamAssessmentQuestion;
	use Domain\Modules\Teacher\Entities\QuizAssessmentChoice;
	use Domain\Modules\Teacher\Entities\QuizAssessmentQuestion;
	use Illuminate\Contracts\Pagination\Paginator;
	use Illuminate\Support\Facades\DB;
	
	class AssessmentRepository implements IAssessmentRepository
	{
		
		
		public function GetAllQuizByCategoryPaginate(string $cat_id, int $page): Paginator
		{
			return StudentQuizAssessmentQuestion::with(['StudentQuizAssessmentChoice'])->where([
				'qacategory_id' => $cat_id,
			])->paginate($page);
		}
		
		public function GetAllExamByCategoryPaginate(string $cat_id, int $page): Paginator
		{
			return StudentExamAssessmentQuestion::with(['StudentExamAssessmentChoice'])->where([
				'eacategory_id' => $cat_id,
			])->paginate($page);
		}
		
		
		public function SaveQuizAssessmentQuestions(QuizAssessmentQuestion $assessmentQuestion, string $sqaquestion_id): void
		{
			$id = uuid();
			
			DB::table('student_quiz_assessment_questions')->insert([
				'id'            => $id,
				'qacategory_id' => $sqaquestion_id,
				'question'      => $assessmentQuestion->getQuestion(),
				'created_at'    => now(),
				'updated_at'    => now()
			]);
			
			foreach ($assessmentQuestion->getChoices() as $choice) {
				/**
				 * @var QuizAssessmentChoice $choice
				 */
				DB::table('student_quiz_assessment_choices')->insert([
					'id'             => uuid(),
					'sqaquestion_id' => $id,
					'order'          => $choice->getOrder(),
					'choice'         => $choice->getChoice(),
					'is_correct'     => $choice->isCorrect(),
					'created_at'     => now(),
					'updated_at'     => now(),
				]);
				
			}
			
		}
		
		
		public function SaveExamAssessmentQuestions(ExamAssessmentQuestion $assessmentQuestion, string $eacategory_id): void
		{
			$id = uuid();
			
			DB::table('student_exam_assessment_questions')->insert([
				'id'            => $id,
				'eacategory_id' => $eacategory_id,
				'question'      => $assessmentQuestion->getQuestion(),
				'created_at'    => now(),
				'updated_at'    => now()
			]);
			
			foreach ($assessmentQuestion->getChoices() as $choice) {
				/**
				 * @var QuizAssessmentChoice $choice
				 */
				DB::table('student_exam_assessment_choices')->insert([
					'id'             => uuid(),
					'seaquestion_id' => $id,
					'order'          => $choice->getOrder(),
					'choice'         => $choice->getChoice(),
					'is_correct'     => $choice->isCorrect(),
					'created_at'     => now(),
					'updated_at'     => now(),
				]);
				
			}
			
		}
		
		public function FindQuizAssessmentQuestions(string $id): object|null
		{
			return StudentQuizAssessmentQuestion::with(['StudentQuizAssessmentChoice'])->where([
				'id' => $id,
			])->first();
		}
		
		public function UpdateQuizAssessmentQuestions(QuizAssessmentQuestion $assessmentQuestion, string $quiz_assessment_question_id): void
		{
			
			DB::table('student_quiz_assessment_questions')->where(['id' => $quiz_assessment_question_id])->update([
				'question' => $assessmentQuestion->getQuestion(),
			]);
			
			$sqac = DB::table('student_quiz_assessment_choices')->where(['sqaquestion_id' => $quiz_assessment_question_id])->get();
			
			foreach ($sqac as $s) {
			
			}
			
			foreach ($assessmentQuestion->getChoices() as $choice) {
				/**
				 * @var QuizAssessmentChoice $choice
				 */
				DB::table('student_quiz_assessment_choices')->where(
					[
						'sqaquestion_id' => $quiz_assessment_question_id,
						'order'          => $choice->getOrder()
					]
				)->update([
					'order'      => $choice->getOrder(),
					'choice'     => $choice->getChoice(),
					'is_correct' => $choice->isCorrect(),
				]);
				
			}
		}
		
		public function SaveExamAssessmentCategory(ExamAssessmentCategory $assessment, string $teaching_load_id): void
		{
			DB::table('student_exam_assessment_categories')->insert([
				'id'               => uuid(),
				'start_date'       => $assessment->getDateStart(),
				'end_date'         => $assessment->getDateEnd(),
				'teaching_load_id' => $teaching_load_id,
				'term'             => $assessment->getTerm(),
				'status'           => $assessment->getStatus(),
				'created_at'       => now(),
				'updated_at'       => now(),
			]);
		}
		
		public function GetExamAssessmentCategory(string $teaching_load_id, int $page): Paginator
		{
			return StudentExamAssessmentCategory::paginate($page);
		}
		
		public function FindExamAssessmentCategory(string $id) : object | null {
			return StudentExamAssessmentCategory::find($id);
		}
	}