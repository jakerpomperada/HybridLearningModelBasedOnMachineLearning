<?php
	
	namespace Domain\Modules\AcademicTerm\Repositories;
	
	use Domain\Modules\AcademicTerm\Entities\AcademicTerm;
	use Illuminate\Contracts\Pagination\Paginator;
	use Illuminate\Support\Facades\DB;
	use Ramsey\Collection\Collection;
	
	interface IAcademicTermRepository
	{
		public function Save(AcademicTerm $academicTerm): void;
		
		public function Update(AcademicTerm $academicTerm): void;
		
		public function Delete(string $id): void;
		
		public function GetAllPaginate(int $page, int $limit): object;
		
		public function GetAll(): object;
		
		public function Find(string $id): AcademicTerm|null;
		
		
		public function GetSemesters(): array;
		
		public function SaveSubjectTerm(
			string $academic_term_semester_id,
			string $course_id,
			string $subject_id,
			string $year_level
		): void;
		
		public function UpdateSubjectTerm(
			string $academic_term_semester_id,
			string $course_id,
			string $subject_id,
			string $year_level,
			string $id
		): void;
		
		
		public function GetAllAcademicTermOnlyYear(): \Illuminate\Support\Collection;
		
		
		public function FindAcademicSemester(string $academic_id, string $semester): object|null;
		
		public function GetAllSubjectTermPaginate(int $page, int $limit): Paginator;
		
		
		public function FindSubjectTerm(string $id): null|object;
		
		
		public function GetAllStudentAdmission(): Paginator;
		
		public function GetCurrentAcademicTerm(): object;
	
	public function removeAllSemesterAsCurrent() : void;
	public function setAsCurrentSemester(string $academic_year_id, string $semester) : void;
		
		
	}
