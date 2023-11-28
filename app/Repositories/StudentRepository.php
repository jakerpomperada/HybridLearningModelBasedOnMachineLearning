<?php

    namespace App\Repositories;

    use App\Models\Student as StudentDB;
    use App\Models\Admission;
    use App\Models\User as UserDB;
    use Domain\Modules\Student\Entities\Student;
    use Domain\Modules\Student\Repositories\IStudentRepository;
    use Domain\Modules\User\Entities\User;
    use Domain\Shared\Address;
    use Domain\Shared\Image;
    use Illuminate\Contracts\Pagination\Paginator;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Support\Facades\DB;

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
                'user_id'                   => $user->id,
                'image'                     => $student->getImage()->getImageName(),
                'id_number'                 => $student->getIdNumber(),
                'firstname'                 => $student->getFirstname(),
                'lastname'                  => $student->getLastname(),
                'middlename'                => $student->getMiddlename(),
                'birthdate'                 => $student->getBirthdate(),
                'contact_number'            => $student->getContactNumber(),
                'address'                   => $student->getAddress()->minifyAddress(),
                'has_internet_connectivity' => $student->isHasInternetConnectivity()
            ]);
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
                $data->middlename,
                $data->lastname,
                $data->birthdate,
                $data->contact_number,
                new Address($data->address),
                $data->id
            );

            $student->setAccount(new User(
                $data->User->username,
                $data->User->password,
                $data->User->id
            ));
            $student->setImage(new Image($data->image));
            $student->setHasInternetConnectivity($data->has_internet_connectivity);

            return $student;
        }

        public function GetYearLevel(): array
        {
            return [
                '1st'  => 'First Year',
                '2nd'  => 'Second Year',
                '3rd'  => 'Third Year',
                '4rth' => 'Fourth Year',

            ];
        }

        public function GetAll(): Collection
        {
            return StudentDB::all();
        }

        public function RegisterAdmission($academic_semester_id, $student_id, $course_id, $year_level, $section): void
        {
            DB::table('admissions')->insert([
                'id'                        => uuid(),
                'academic_term_semester_id' => $academic_semester_id,
                'student_id'                => $student_id,
                'course_id'                 => $course_id,
                'year_level'                => $year_level,
                'section'                   => $section,
                'created_at'                => now(),
                'updated_at'                => now(),
            ]);
        }

        public function UpdateAdmission($academic_semester_id, $student_id, $course_id, $year_level,
                                        $section, $id): void
        {
            DB::table('admissions')->where(['id' => $id])->update([
                'academic_term_semester_id' => $academic_semester_id,
                'student_id'                => $student_id,
                'course_id'                 => $course_id,
                'year_level'                => $year_level,
                'section'                   => $section,
                'updated_at'                => now(),
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
                'image'                     => $student->getImage()->getImageName(),
                'id_number'                 => $student->getIdNumber(),
                'firstname'                 => $student->getFirstname(),
                'lastname'                  => $student->getLastname(),
                'middlename'                => $student->getMiddlename(),
                'birthdate'                 => $student->getBirthdate(),
                'contact_number'            => $student->getContactNumber(),
                'address'                   => $student->getAddress()->value(),
                'has_internet_connectivity' => $student->isHasInternetConnectivity()
            ]);
        }

        public function FindAdmissionData(string $id): object|null
        {
            return Admission::with(['Student', 'Course', 'AcademicTermSemester.AcademicTerm'])->where([
                'id' => $id
            ])->first();
        }

        public function RemoveAdmission(string $id): void
        {
            DB::table('admissions')->delete($id);
        }

        public function Delete(string $id): void
        {
            StudentDB::destroy($id);
        }

        public function GetAllAdmission(): Collection
        {
            return Admission::with(['Student'])->get();
        }

        public function recordAttendance(array $records): void
        {
            DB::table('student_attendances')->insert($records);
        }

        public function GetStudentInfoWithUserId(string $user_id): object|null
        {
            $user = UserDB::with(['Student'])->where(['id' => $user_id])->first();
            return $user->Student;

        }

        public function FindByUserId(string $user_id): object
        {
            $user = UserDB::with(['Student'])->where(['id' => $user_id])->first();
            return $user->Student;
        }

        public function CountAll(): int
        {
            return DB::table('students')->count();
        }


    }
