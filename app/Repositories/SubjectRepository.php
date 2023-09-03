<?php

    namespace App\Repositories;

    use Domain\Modules\Subject\Entities\Subject;
    use Domain\Modules\Subject\Repositories\ISubjectRepository;
    use Illuminate\Contracts\Pagination\Paginator;
    use App\Models\Subject as SubjectDB;

    class SubjectRepository implements ISubjectRepository
    {


        public function Save(Subject $subject): void
        {
            SubjectDB::create([
                'code'        => $subject->getCode(),
                'description' => $subject->getDescription()
            ]);
        }

        public function Update(Subject $subject): void
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
    }
