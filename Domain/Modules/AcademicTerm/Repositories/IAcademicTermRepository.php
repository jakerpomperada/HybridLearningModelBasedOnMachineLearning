<?php

	namespace Domain\Modules\AcademicTerm\Repositories;

	use Domain\Modules\AcademicTerm\Entities\AcademicTerm;
    use Illuminate\Contracts\Pagination\Paginator;

    interface IAcademicTermRepository
	{
        public function Save(AcademicTerm $academicTerm) : void;

        public function Update(AcademicTerm $academicTerm) : void;

        public function Delete(string $id) : void;

        public function GetAllPaginate(int $page, int $limit) : object;

        public function Find(string $id) : AcademicTerm | null;



	}
