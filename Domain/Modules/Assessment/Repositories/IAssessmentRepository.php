<?php
	
	namespace Domain\Modules\Assessment\Repositories;
	
	use Domain\Modules\Teacher\Entities\QuizAssessmentQuestion;
	use Illuminate\Contracts\Pagination\Paginator;
	
	interface IAssessmentRepository
	{
	
		public function GetAllQuizByCategoryPaginate(string $cat_id, int $page) : Paginator;
		
		public function SaveQuizAssessmentQuestions(QuizAssessmentQuestion $assessmentQuestion, string $sqaquestion_id) : void;
		
		
		
	}