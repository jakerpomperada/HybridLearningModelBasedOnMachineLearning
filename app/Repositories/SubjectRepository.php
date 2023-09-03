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
           SubjectDB::where(['id' => $subject->getId()])->update([
               'code'        => $subject->getCode(),
               'description' => $subject->getDescription()
           ]);
        }

        public function Delete(string $id): void
        {
            SubjectDB::destroy($id);
        }

        public function GetAllPaginate(int $page, int $limit): Paginator
        {
           return SubjectDB::paginate($limit);
        }

        public function Find(string $id): object
        {
            return SubjectDB::find($id);
        }
    }
