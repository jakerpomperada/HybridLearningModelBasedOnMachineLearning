<?php
	
	namespace Domain\Modules\Teacher\Repositories;
	
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
		
		public function GetAllTeachingLoadPaginate(int $page, int $limit) : Paginator;
		
		public function GetAllTeachingLoads(string $teacher_id) : Collection;
		
		public function FindTeachingLoad(string $id) : object | null;
		
		public function UpdateTeachingLoad(
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
			string $course_id
		): void;
		
		public function DeleteTeachingLoad(string $id) : void;
		
	}
