<?php

	namespace Domain\Modules\Teacher\Repositories;

	use Domain\Modules\Teacher\Entities\ExamCategory;
	use Domain\Modules\Teacher\Entities\ExamScore;
	use Domain\Modules\Teacher\Entities\ParticipationCategory;
	use Domain\Modules\Teacher\Entities\ParticipationScore;
	use Domain\Modules\Teacher\Entities\QuizAssessmentCategory;
	use Domain\Modules\Teacher\Entities\QuizCategory;
	use Domain\Modules\Teacher\Entities\QuizScore;
	use Domain\Modules\Teacher\Entities\TaskPerformanceCategory;
	use Domain\Modules\Teacher\Entities\TaskPerformanceScore;
	use Domain\Modules\Teacher\Entities\Teacher;
	use Illuminate\Contracts\Pagination\Paginator;
	use Illuminate\Database\Eloquent\Collection;

	interface ITeacherRepository
	{
		public function Save(Teacher $teacher): void;

		public function Update(Teacher $teacher): void;

		public function Delete(string $id): void;

		public function GetAllPaginate(int $page, int $limit): Paginator;

		public function GetAll(): Collection;

		public function GetAllTeachingLoadPaginate(int $page, int $limit): Paginator;

		public function GetAllTeachingLoads(string $teacher_id): Collection;

		public function FindTeachingLoad(string $id): object|null;

		public function UpdateTeachingLoad(
            string $academic_term_semester_id,
          	string $teacher_id,
			string $subject_id,
			string $year_level,
			string $section,
			string $semester,
			string $course_id,
			string $id
		): void;

		public function Find(string $id): object|null;

		public function SaveTeachingLoad(
          	string $teacher_id,
			string $subject_id,
			string $year_level,
			string $section,
			string $semester,
			string $course_id,
			string $academic_term_semester_id
		): void;

		public function DeleteTeachingLoad(string $id): void;

		public function GetAllStudentAttendanceGroupByDate(string $teaching_load_id): Paginator;

		public function GetAllStudentAttendanceFindByDate(string $teaching_load_id, string $date): \Illuminate\Support\Collection;


		public function showAllStudentAttendance(string $teaching_load_id, string $date) : Collection;


		public function DeleteStudentAttendance(string $teaching_load_id, string $date) : void;

		public function SaveStudentAttendance(array $records) : void;


		public function GetAllStudentParticipationByTeachingLoadGroupByDate(
			string $teaching_load_id
		) : Paginator;

		public function GetAllStudentExamsByTeachingLoadGroupByDate(
			string $teaching_load_id
		): Paginator;

		public function GetAllStudentQuizzesByTeachingLoadGroupByDate(
			string $teaching_load_id
		): Paginator;

		public function GetAllStudentTaskPerformanceByTeachingLoadGroupByDate(
			string $teaching_load_id
		) : Paginator;

		public function SaveStudentParticipationCategory(
			ParticipationCategory $participationCategory, string  $teaching_load_id) :
		void;

		public function SaveStudentParticipationScore(
			ParticipationScore $participationScore,
			string $student_participation_category_id,
			string $student_admission_id
		) : void;

		public function SaveStudentTaskPerformanceCategory(
			TaskPerformanceCategory $taskPerformance, string  $teaching_load_id) :
		void;

		public function SaveStudentQuizCategory(
			QuizCategory $quizCategory, string  $teaching_load_id) :
		void;

		public function SaveStudentTaskPerformanceScore(
			TaskPerformanceScore $taskPerformanceScore,
			string $student_taskPerformance_category_id,
			string $student_admission_id
		) : void;

		public function SaveStudentQuizScore(
			QuizScore $quizScore,
			string $student_taskPerformance_category_id,
			string $student_admission_id
		) : void;



		public function SaveStudentExamCategory(
			ExamCategory $examCategory, string  $teaching_load_id) :
		void;

		public function SaveStudentExamScore(
			ExamScore $examScore,
			string $student_exam_category_id,
			string $student_admission_id
		) : void;

		public function SaveQuizAssessmentCategory(
			QuizAssessmentCategory $quizAssessmentCategory, string  $teaching_load_id) :
		void;

		public function GetQuizAssessmentCategoryByTeachingLoadGroupByDate(
			string $teaching_load_id
		) : Paginator;

		public function GetAllStudentQuizAssessmentByTeachingLoadGroupByDate(
			string $teaching_load_id
		) : Paginator;


		public function CountAll() : int;








	}
