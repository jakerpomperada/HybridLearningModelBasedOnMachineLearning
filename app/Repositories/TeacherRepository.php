<?php

    namespace App\Repositories;

    use Domain\Modules\Teacher\Entities\Teacher;
    use Domain\Modules\Teacher\Repositories\ITeacherRepository;
    use Illuminate\Contracts\Pagination\Paginator;
    use Illuminate\Support\Facades\DB;
    use App\Models\Teacher as TeacherDB;

    class TeacherRepository implements ITeacherRepository
    {

        public function Save(Teacher $teacher): void
        {
            DB::table('teachers')->insert([
                'id'             => $teacher->getId(),
                'image'          => $teacher->getImage()->getImageName(),
                'id_number'      => $teacher->getIdNumber(),
                'firstname'      => $teacher->getFirstname(),
                'lastname'       => $teacher->getLastname(),
                'middlename'     => $teacher->getMiddlename(),
                'birthdate'      => $teacher->getBirthdate(),
                'contact_number' => $teacher->getContactNumber(),
                'address'        => $teacher->getAddress(),
                'created_at'     => now(),
                'updated_at'     => now(),
                ]);
        }

        public function Update(Teacher $teacher): void
        {
            // TODO: Implement Update() method.
        }

        public function Delete(string $id): void
        {
            // TODO: Implement Delete() method.
        }

        public function GetAllPaginate(int $page, int $limit): Paginator
        {
          return TeacherDB::paginate($limit);
        }
    }
