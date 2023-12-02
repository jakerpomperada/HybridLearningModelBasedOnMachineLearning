<?php

	namespace Domain\Modules\Assessment\Repositories;

	use Domain\Modules\Assessment\Entities\ExamAssessmentCategory;
	use Domain\Modules\Teacher\Entities\ExamAssessmentQuestion;
	use Domain\Modules\Teacher\Entities\QuizAssessmentQuestion;
	use Illuminate\Contracts\Pagination\Paginator;
    use Illuminate\Database\Eloquent\Collection;

    interface IAssessmentRepository
	{

		public function GetAllQuizByCategoryPaginate(string $cat_id, int $page): Paginator;

		public function GetAllExamByCategoryPaginate(string $cat_id, int $page): Paginator;

		public function SaveQuizAssessmentQuestions(QuizAssessmentQuestion $assessmentQuestion, string $sqaquestion_id): void;

		public function SaveExamAssessmentQuestions(
			ExamAssessmentQuestion $assessmentQuestion, string $eacategory_id
		): void;

		public function UpdateQuizAssessmentQuestions(QuizAssessmentQuestion $assessmentQuestion, string $quiz_assessment_question_id): void;

		public function UpdateExamAssessmentQuestions(ExamAssessmentQuestion $assessmentQuestion, string $exam_assessment_question_id): void;

		public function FindQuizAssessmentQuestions(string $id): object|null;

        public function FindQuizCategory(string $id): object|null;

		public function SaveExamAssessmentCategory(ExamAssessmentCategory $assessment, string $teaching_load_id): void;

		public function GetExamAssessmentCategory(string $teaching_load_id, int $page): Paginator;

		public function GetQuizAssessmentCategory(string $teaching_load_id, int $page): Paginator;

        public function GetQuizAssessmentCategoryAllWithRelation(array $relations, string $teaching_load_id): Collection|array;

        public function GetQuizQuestionsAllWithRelation(array $relations, string $qacategory_id): Collection|array;

		public function FindExamAssessmentCategory(string $id) : object | null;

		public function FindExamAssessmentQuestion(string $id) : object | null;

        public function GetAllQuizAssessmentByCategoryScores(string $quiz_category_id, string $admission_id ) : array;

        public function FindQuizAssessmentGetScoreByCategory(string $quiz_category_id, string $admission_id ) : object ;




	}
