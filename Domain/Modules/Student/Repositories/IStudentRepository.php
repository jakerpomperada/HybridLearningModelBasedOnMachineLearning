<?php

	namespace Domain\Modules\Student\Repositories;

	use Domain\Modules\Student\Entities\Student;
    use Domain\Modules\Teacher\Entities\Teacher;
    use Illuminate\Contracts\Pagination\Paginator;
	use Illuminate\Database\Eloquent\Collection;
	
	interface IStudentRepository
	{
        public function Save(Student $student) : void;
        public function Update(Student $student, string $user_id) : void;
        public function Delete(string $id) : void;
        public function GetAllPaginate(int $page, int $limit) : Paginator;

        public function Find(string $id) : Student | null;

        public function Aggregates(object $data) : Student;

        public function GetYearLevel() : array;
		
		public function GetAll() : Collection;

	}
