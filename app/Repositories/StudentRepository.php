<?php

    namespace App\Repositories;

    use App\Models\User as UserDB;
    use Domain\Modules\Student\Entities\Student;
    use Domain\Modules\Student\Repositories\IStudentRepository;
    use Domain\Shared\Image;
    use Domain\Shared\User;
    use Illuminate\Contracts\Pagination\Paginator;
    use App\Models\Student as StudentDB;

    class StudentRepository implements IStudentRepository
    {

        public function Save(Student $student): void
        {

            $user = UserDB::create([
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

        public function Update(Student $student, string $user_id): void
        {

            if (!empty($student->getPassword())) {
                UserDB::where('id', $user_id)->update([
                    'password' => $student->getAccount()->getHashPassword(),
                ]);
            }
            UserDB::where('id', $user_id)->update([
                'username' => $student->getAccount()->getUsername(),
            ]);

            StudentDB::where('id', $student->getId())->update([
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

        public function Delete(string $id): void
        {
           StudentDB::destroy($id);
        }

        public function GetAllPaginate(int $page, int $limit): Paginator
        {
            return StudentDB::paginate($limit);
        }

        public function Find(string $id): Student|null
        {
            $data = StudentDB::with(['User'])->where(['id' => $id])->first();

            return (!$data) ? null : $this->Aggregates($data);
        }

        public function Aggregates(object $data): Student
        {
            $student = new Student(
                $data->id_number,
                $data->firstname,
                $data->lastname,
                $data->middlename,
                $data->birthdate,
                $data->contact_number,
                $data->address,
                $data->id
            );

            $student->setAccount(new User(
                $data->User->username,
                $data->User->password,
                $data->User->id
            ));
            $student->setImage(new Image($data->image));

            return $student;
        }
    }
