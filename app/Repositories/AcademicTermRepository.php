<?php

    namespace App\Repositories;

    use Domain\Modules\AcademicTerm\Entities\AcademicTerm;
    use Domain\Modules\AcademicTerm\Repositories\IAcademicTermRepository;
    use Illuminate\Contracts\Pagination\Paginator;
    use Illuminate\Support\Facades\DB;

    use App\Models\AcademicTerm as AcademicTermDB;

    class AcademicTermRepository implements IAcademicTermRepository
    {

        public function Save(AcademicTerm $academicTerm): void
        {
            AcademicTermDB::create([
                'year_from' => $academicTerm->getYearFrom(),
                'year_to'   => $academicTerm->getYearTo(),
            ]);

        }

        public function Update(AcademicTerm $academicTerm): void
        {
            // TODO: Implement Update() method.
        }

        public function Delete(string $id): void
        {
            // TODO: Implement Delete() method.
        }

        public function GetAllPaginate(int $page, int $limit): object
        {
            $data = AcademicTermDB::paginate($limit);

            $terms =  collect($data->items())->map(function ($d) {
                return $this->Aggregate($d);
            });

            return (object) [
                'terms' => $terms,
                'paginate' => $data->links()
            ];
        }

        public function Find(string $id): AcademicTerm|null
        {
            $data = DB::table('academic_terms')->find($id);
            return !$data ? null :  $this->Aggregate($data);
        }

        public function Aggregate( object $term) : AcademicTerm {
            return new AcademicTerm($term->year_from, $term->year_to, $term->id);
        }
    }
