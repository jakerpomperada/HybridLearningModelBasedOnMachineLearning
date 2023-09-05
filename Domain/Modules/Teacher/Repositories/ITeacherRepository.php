<?php

	namespace Domain\Modules\Teacher\Repositories;

	use Domain\Modules\Teacher\Entities\Teacher;

    interface ITeacherRepository
	{
        public function Save(Teacher $teacher) : void;
        public function Update(Teacher $teacher) : void;
        public function Delete(string $id) : void;
        public function GetAllPaginate(int $page, int $limit) : void;

	}
