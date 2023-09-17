<?php

	namespace App\Repositories;

	use Domain\Modules\AcademicTerm\Entities\AcademicTerm;
    use Domain\Modules\AcademicTerm\Repositories\IAcademicTermRepository;
    use Illuminate\Contracts\Pagination\Paginator;

    class AcademicTermRepository implements IAcademicTermRepository
	{

        public function Save(AcademicTerm $academicTerm): void
        {
            // TODO: Implement Save() method.
        }

        public function Update(AcademicTerm $academicTerm): void
        {
            // TODO: Implement Update() method.
        }

        public function Delete(string $id): void
        {
            // TODO: Implement Delete() method.
        }

        public function GetAllPaginate(int $page, int $limit): Paginator
        {
            // TODO: Implement GetAllPaginate() method.
        }

        public function find(string $id): AcademicTerm|null
        {
            // TODO: Implement find() method.
        }
    }
