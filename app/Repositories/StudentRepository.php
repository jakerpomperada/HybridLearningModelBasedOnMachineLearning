<?php

    namespace App\Repositories;

    use App\Models\User;
    use Domain\Modules\Student\Entities\Student;
    use Domain\Modules\Student\Repositories\IStudentRepository;
    use Illuminate\Contracts\Pagination\Paginator;
    use App\Models\Student as StudentDB;

    class StudentRepository implements IStudentRepository
    {

        public function Save(Student $student): void
        {

            $user = User::create([
                'username' => $student->getAccount()->getUsername(),
                'password' => $student->getAccount()->getHashPassword(),
                'type'     => 'student'
            ]);
            StudentDB::create([
                'user_id'        => $user->id,
                'image'          => $student->getImage()->getImageName(),
                'id_number'      => $student->getIdNumber(),
                'firstname'      => $student->getFirstname(),
                'lastname'       => $student->getLastname(),
                'middlename'     => $student->getMiddlename(),
                'birthdate'      => $student->getBirthdate(),
                'contact_number' => $student->getContactNumber(),
                'address'        => $student->getAddress(),
            ]);
        }

        public function Update(Student $student): void
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

        public function Find(string $id): object|null
        {
            // TODO: Implement Find() method.
        }
    }
