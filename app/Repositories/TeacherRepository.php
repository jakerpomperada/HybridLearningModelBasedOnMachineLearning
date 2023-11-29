<?php

    namespace App\Repositories;

    use App\Models\StudentAttendance;
    use App\Models\StudentExamCategory;
    use App\Models\StudentParticipationCategory;
    use App\Models\StudentQuizAssessmentCategory;
    use App\Models\StudentQuizCategory;
    use App\Models\StudentTaskPerformanceCategory;
    use App\Models\Teacher as TeacherDB;
    use App\Models\TeachingLoad;
    use Domain\Modules\Teacher\Entities\ExamCategory;
    use Domain\Modules\Teacher\Entities\ExamScore;
    use Domain\Modules\Teacher\Entities\ParticipationCategory;
    use Domain\Modules\Teacher\Entities\ParticipationScore;
    use Domain\Modules\Teacher\Entities\QuizAssessmentCategory;
    use Domain\Modules\Teacher\Entities\QuizCategory;
    use Domain\Modules\Teacher\Entities\QuizScore;
    use Domain\Modules\Teacher\Entities\TaskPerformanceCategory;
    use Domain\Modules\Teacher\Entities\TaskPerformanceScore;
    use Domain\Modules\Teacher\Entities\Teacher;
    use Domain\Modules\Teacher\Repositories\ITeacherRepository;
    use Illuminate\Contracts\Pagination\Paginator;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Support\Facades\DB;

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

        public function GetAllPaginate(int $page, int $limit): Paginator
        {
            return TeacherDB::paginate($limit);
        }

        public function GetAll(): Collection
        {
            return TeacherDB::all();
        }

        public function SaveTeachingLoad(
            string $teacher_id,
            string $subject_id,
            string $year_level,
            string $section,
            string $semester,
            string $course_id,
            string $academic_term_semester_id
        ): void
        {


            DB::table('teaching_loads')->insert([
                'id'                        => uuid(),
                'teacher_id'                => $teacher_id,
                'subject_id'                => $subject_id,
                'year_level'                => $year_level,
                'section'                   => $section,
                'semester'                  => $semester,
                'course_id'                 => $course_id,
                'academic_term_semester_id' => $academic_term_semester_id,
                'created_at'                => now(),
                'updated_at'                => now(),
            ]);
        }

        public function GetAllTeachingLoadPaginate(int $page, int $limit): Paginator
        {
            return TeachingLoad::with([
                'Teacher', 'Subject', 'Course', 'AcademicTermSemester'
            ])->paginate($limit);
        }

        public function UpdateTeachingLoad(string $academic_term_semester_id, string $teacher_id, string $subject_id, string $year_level, string $section, string $semester, string $course_id, string $id): void
        {
            TeachingLoad::find($id)->update([
                'teacher_id'                => $teacher_id,
                'subject_id'                => $subject_id,
                'year_level'                => $year_level,
                'academic_term_semester_id' => $academic_term_semester_id,
                'section'                   => $section,
                'semester'                  => $semester,
                'course_id'                 => $course_id,
                'updated_at'                => now(),
            ]);
        }

        public function Update(Teacher $teacher): void
        {
            TeacherDB::where(['id' => $teacher->getId()])->update([
                'image'          => $teacher->getImage()->getImageName(),
                'id_number'      => $teacher->getIdNumber(),
                'firstname'      => $teacher->getFirstname(),
                'lastname'       => $teacher->getLastname(),
                'middlename'     => $teacher->getMiddlename(),
                'birthdate'      => $teacher->getBirthdate(),
                'contact_number' => $teacher->getContactNumber(),
                'address'        => $teacher->getAddress()
            ]);
        }

        public function Find(string $id): object|null
        {
            return DB::table('teachers')->where(['id' => $id])->first();
        }

        public function FindTeachingLoad(string $id): object|null
        {
            return TeachingLoad::with([
                'Subject', 'Course', 'AcademicTermSemester'
            ])->where(['id' => $id])->first();
        }

        public function DeleteTeachingLoad(string $id): void
        {
            DB::table('teaching_loads')->delete($id);
        }

        public function Delete(string $id): void
        {
            DB::table('teachers')->delete($id);
        }

        public function GetAllTeachingLoads(string $teacher_id): Collection
        {
            return TeachingLoad::where(['teacher_id' => $teacher_id])->get();
        }

        public function GetAllStudentAttendanceGroupByDate(string $teaching_load_id): Paginator
        {
            return StudentAttendance::with([
                'TeachingLoad.Subject'
            ])->where(['teaching_load_id' => $teaching_load_id])->groupBy('date')->paginate(5);
        }

        public function GetAllStudentAttendanceFindByDate(string $teaching_load_id, string $date): \Illuminate\Support\Collection
        {
            return DB::table('student_attendances')->where(['teaching_load_id' => $teaching_load_id, 'date' => $date])->get();
        }

        public function showAllStudentAttendance(string $teaching_load_id, string $date): Collection
        {
            return StudentAttendance::with(['Admission.Student'])->where([
                'date'             => $date,
                'teaching_load_id' => $teaching_load_id,
            ])->get();
        }


        public function DeleteStudentAttendance(string $teaching_load_id, string $date): void
        {
            DB::table('student_attendances')->where([
                'teaching_load_id' => $teaching_load_id,
                'date'             => $date
            ])->delete();
        }

        public function SaveStudentAttendance(array $records): void
        {
            DB::table('student_attendances')->insert($records);
        }


        public function GetAllStudentParticipationByTeachingLoadGroupByDate(string $teaching_load_id): Paginator
        {
            return StudentParticipationCategory::where([
                'teaching_load_id' => $teaching_load_id
            ])->paginate(5);
        }

        public function GetAllStudentQuizzesByTeachingLoadGroupByDate(string $teaching_load_id): Paginator
        {
            return StudentQuizCategory::where([
                'teaching_load_id' => $teaching_load_id
            ])->paginate(5);
        }

        public function GetAllStudentExamsByTeachingLoadGroupByDate(string $teaching_load_id): Paginator
        {
            return StudentExamCategory::where([
                'teaching_load_id' => $teaching_load_id
            ])->paginate(5);
        }


        public function GetAllStudentTaskPerformanceByTeachingLoadGroupByDate(string $teaching_load_id): Paginator
        {
            return StudentTaskPerformanceCategory::where([
                'teaching_load_id' => $teaching_load_id
            ])->paginate(5);
        }

        public function SaveStudentParticipationCategory(ParticipationCategory $participationCategory, string $teaching_load_id): void
        {

            DB::table('student_participation_categories')->insert([
                'id'               => $participationCategory->getId(),
                'date'             => $participationCategory->getDate(),
                'teaching_load_id' => $teaching_load_id,
                'points'           => $participationCategory->getPoints(),
                'title'            => $participationCategory->getTitle(),
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
        }

        public function SaveStudentParticipationScore(ParticipationScore $participationScore, string $student_participation_category_id, string $student_admission_id): void
        {
            DB::table('student_participations')->insert([
                'id'                                => uuid(),
                'student_participation_category_id' => $student_participation_category_id,
                'student_admission_id'              => $student_admission_id,
                'score'                             => $participationScore->getScore(),
                'created_at'                        => now(),
                'updated_at'                        => now(),
            ]);
        }

        public function SaveStudentTaskPerformanceCategory(TaskPerformanceCategory $taskPerformance, string $teaching_load_id): void
        {
            DB::table('student_task_performance_categories')->insert([
                'id'               => $taskPerformance->getId(),
                'date'             => $taskPerformance->getDate(),
                'teaching_load_id' => $teaching_load_id,
                'points'           => $taskPerformance->getPoints(),
                'title'            => $taskPerformance->getTitle(),
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
        }

        public function SaveStudentTaskPerformanceScore(TaskPerformanceScore $taskPerformanceScore, string $student_taskPerformance_category_id, string $student_admission_id): void
        {
            DB::table('student_task_performances')->insert([
                'id'                   => uuid(),
                'stpc_id'              => $student_taskPerformance_category_id,
                'student_admission_id' => $student_admission_id,
                'score'                => $taskPerformanceScore->getScore(),
                'created_at'           => now(),
                'updated_at'           => now(),
            ]);
        }

        public function SaveStudentQuizCategory(QuizCategory $quizCategory, string $teaching_load_id): void
        {
            DB::table('student_quiz_categories')->insert([
                'id'               => $quizCategory->getId(),
                'date'             => $quizCategory->getDate(),
                'teaching_load_id' => $teaching_load_id,
                'points'           => $quizCategory->getPoints(),
                'title'            => $quizCategory->getTitle(),
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
        }

        public function SaveStudentQuizScore(QuizScore $quizScore, string $student_taskPerformance_category_id, string $student_admission_id): void
        {
            DB::table('student_quizzes')->insert([
                'id'                       => uuid(),
                'student_quiz_category_id' => $student_taskPerformance_category_id,
                'student_admission_id'     => $student_admission_id,
                'score'                    => $quizScore->getScore(),
                'created_at'               => now(),
                'updated_at'               => now(),
            ]);
        }

        public function SaveStudentExamCategory(ExamCategory $examCategory, string $teaching_load_id): void
        {
            DB::table('student_exam_categories')->insert([
                'id'               => $examCategory->getId(),
                'date'             => $examCategory->getDate(),
                'teaching_load_id' => $teaching_load_id,
                'points'           => $examCategory->getPoints(),
                'title'            => $examCategory->getTitle(),
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
        }

        public function SaveStudentExamScore(ExamScore $examScore, string $student_exam_category_id, string $student_admission_id): void
        {
            DB::table('student_exams')->insert([
                'id'                       => uuid(),
                'student_exam_category_id' => $student_exam_category_id,
                'student_admission_id'     => $student_admission_id,
                'score'                    => $examScore->getScore(),
                'created_at'               => now(),
                'updated_at'               => now(),
            ]);
        }

        public function SaveQuizAssessmentCategory(QuizAssessmentCategory $quizAssessmentCategory, string $teaching_load_id): void
        {
            DB::table('student_quiz_assessment_categories')->insert([
                'id'               => $quizAssessmentCategory->getId(),
                'start_date'       => $quizAssessmentCategory->getDateStart(),
                'end_date'         => $quizAssessmentCategory->getDateEnd(),
                'teaching_load_id' => $teaching_load_id,
                'title'            => $quizAssessmentCategory->getTitle(),
                'status'           => $quizAssessmentCategory->getStatus(),
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
        }

        public function GetQuizAssessmentCategoryByTeachingLoadGroupByDate(string $teaching_load_id): Paginator
        {
            return StudentQuizCategory::where(['teaching_load_id' => $teaching_load_id])->paginate(5);
        }


        public function GetAllStudentQuizAssessmentByTeachingLoadGroupByDate(string $teaching_load_id): Paginator
        {
            return StudentQuizAssessmentCategory::where(['teaching_load_id' => $teaching_load_id])->paginate(5);
        }

        public function CountAll(): int
        {
            return DB::table('teachers')->count();
        }


    }
