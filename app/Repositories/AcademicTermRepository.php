<?php

    namespace App\Repositories;

    use App\Models\AcademicTermSubject;
    use App\Models\Admission;
    use Domain\Modules\AcademicTerm\Entities\AcademicTerm;
    use Domain\Modules\AcademicTerm\Repositories\IAcademicTermRepository;
    use Illuminate\Contracts\Pagination\Paginator;
    use Illuminate\Support\Collection;
    use Illuminate\Support\Facades\DB;

    use App\Models\AcademicTerm as AcademicTermDB;

    class AcademicTermRepository extends Repository implements IAcademicTermRepository
    {


        public function Save(AcademicTerm $academicTerm): void
        {
            $id = $academicTerm->getId();

            AcademicTermDB::create([
                'id'        => $id,
                'year_from' => $academicTerm->getYearFrom(),
                'year_to'   => $academicTerm->getYearTo(),
            ]);

            $this->insertSemesters($id);
        }

        private function insertSemesters(string $academic_id): void
        {
            DB::table('academic_term_semesters')->insert([
                'id'          => uuid(),
                'academic_id' => $academic_id,
                'semester'    => '1st',
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
            DB::table('academic_term_semesters')->insert([
                'id'          => uuid(),
                'academic_id' => $academic_id,
                'semester'    => '2nd',
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }

        public function GetAllPaginate(int $page, int $limit): object
        {
            $data = AcademicTermDB::paginate($limit);

            $terms = collect($data->items())->map(function ($d) {
                return $this->Aggregate($d);
            });

            return (object)[
                'terms'    => $terms,
                'paginate' => $data->links()
            ];
        }

        public function Aggregate(object $term): AcademicTerm
        {
            return new AcademicTerm($term->year_from, $term->year_to, $term->id);
        }

        public function GetAll(): object
        {
            $data = AcademicTermDB::all();

            return $data->map(function ($d) {
                return $this->Aggregate($d);
            });
        }

        public function Find(string $id): AcademicTerm|null
        {
            $data = DB::table('academic_terms')->find($id);
            return !$data ? null : $this->Aggregate($data);
        }

        public function GetSemesters(): array
        {
            return [
                '1st' => 'First Semester',
                '2nd' => 'Second Semester'
            ];
        }

        public function FindAcademicSemester(string $academic_id, string $semester): object|null
        {
            return DB::table('academic_term_semesters')->where([
                'academic_id' => $academic_id,
                'semester'    => $semester,
            ])->first();
        }

        public function GetAllSubjectTermPaginate(int $page, int $limit): Paginator
        {
            return AcademicTermSubject::with(['AcademicTermSemester.AcademicTerm', 'Course'])->paginate($limit);
        }

        public function FindSubjectTerm(string $id): null|object
        {
            return AcademicTermSubject::with(['AcademicTermSemester.AcademicTerm', 'Course'])->where([
                'id' => $id
            ])->first();
        }

        public function SaveSubjectTerm(string $academic_term_semester_id, string $course_id, string $subject_id, string $year_level): void
        {
            DB::table('academic_term_subjects')->insert([
                'id'                        => uuid(),
                'academic_term_semester_id' => $academic_term_semester_id,
                'course_id'                 => $course_id,
                'subject_id'                => $subject_id,
                'year_level'                => $year_level,
                'created_at'                => now(),
                'updated_at'                => now(),
            ]);
        }

        public function UpdateSubjectTerm(string $academic_term_semester_id, string $course_id, string $subject_id, string $year_level, string $id): void
        {
            DB::table('academic_term_subjects')->where(['id' => $id])->update([
                'id'                        => uuid(),
                'academic_term_semester_id' => $academic_term_semester_id,
                'course_id'                 => $course_id,
                'subject_id'                => $subject_id,
                'year_level'                => $year_level,
                'updated_at'                => now(),
            ]);
        }

        public function Update(AcademicTerm $academicTerm): void
        {
            AcademicTermDB::where(['id' => $academicTerm->getId()])->update([
                'year_from' => $academicTerm->getYearFrom(),
                'year_to'   => $academicTerm->getYearTo(),
            ]);
        }

        public function DeleteSubjectTerm(string $id): void
        {
            DB::table('academic_term_subjects')->where(['id' => $id])->delete();
        }

        public function Delete(string $id): void
        {
            AcademicTermDB::destroy($id);
        }

        public function GetAllStudentAdmission(): Paginator
        {
            return Admission::with(['Student', 'Course', 'AcademicTermSemester.AcademicTerm'])->paginate(5);
        }

        public function GetCurrentAcademicTerm(): null|object
        {
            $sql = "SELECT ats.id, academic_id, semester, is_current, a.year_from, a.year_to ";
            $sql .= "FROM academic_term_semesters ats ";
            $sql .= "LEFT JOIN academic_terms a on ats.academic_id = a.id ";
            $sql .= "WHERE ats.is_current = 1 ";
            $sql .= "LIMIT 1";
            $result = DB::select($sql);
            return (!$result) ? null : $result[0];
        }


        public function GetAllAcademicTermOnlyYear(): Collection
        {
            return AcademicTermDB::all();
        }

        public function removeAllSemesterAsCurrent(): void
        {
            DB::table('academic_term_semesters')->update([
                'is_current' => 0
            ]);
        }

        public function setAsCurrentSemester(string $academic_year_id, string $semester): void
        {
            DB::table('academic_term_semesters')->where([
                'academic_id' => $academic_year_id,
                'semester'    => $semester
            ])->update([
                'is_current' => 1
            ]);
        }


        public function FindTermByTermIdSemester(string $term_id, string $semester): object|null
        {
            $sql = "SELECT at.id as term_id, ats.id as term_semester_id ";
            $sql .= "FROM academic_terms at ";
            $sql .= " LEFT JOIN academic_term_semesters ats on at.id = ats.academic_id ";
            $sql .= "WHERE at.id = '".$term_id."' ";
            $sql .= "  AND ats.semester = '".$semester."' ";
            $sql .= "LIMIT 1";
            return $this->find_query($sql);

        }


    }
