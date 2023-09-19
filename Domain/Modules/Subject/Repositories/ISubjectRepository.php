<?php

	namespace Domain\Modules\Subject\Repositories;

	use Domain\Modules\Subject\Entities\Subject;
    use Illuminate\Contracts\Pagination\Paginator;

    interface ISubjectRepository
	{

        public function Save(Subject $subject) : void;

        public function Update(Subject $subject) : void;

        public function Delete(string $id): void;

        public function GetAllPaginate(int $page, int $limit) : Paginator;

        public function GetAll() : object;
        public function Find(string $id) : object;


	}
