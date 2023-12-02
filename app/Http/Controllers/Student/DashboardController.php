<?php

    namespace App\Http\Controllers\Student;

    use App\Http\Controllers\Controller;
    use App\Http\Controllers\StudentAdmissionController;
    use App\Models\Admission;
    use App\Models\Student;
    use Domain\Modules\Student\Repositories\IStudentRepository;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\View\View;

    class DashboardController extends Controller
    {

        protected IStudentRepository $studentRepository;


        public function __construct(IStudentRepository $studentRepository)
        {
            $this->studentRepository = $studentRepository;
        }


        public function index(): View
        {
            $student = Student::with(['Admission'])->where([
                'user_id' => Auth::id()
            ])->first();

            $academic_term_semester_id = $this->getAcademicSemesterTerm()->id;

            if (!$student?->Admission) {
                $classmates = [];
            } else {
                $admission = $student->Admission;
                $classmates = $this->studentRepository->GetAllClassmatesLimitBy(
                    $academic_term_semester_id, $admission->course_id, $admission->year_level, $admission->section
                );
            }
            $displaySemester = $this->getCurrentTerm()->displaySemester();

            $classmates = collect($classmates)->map(function ($c) use ($displaySemester) {
                return (object)[
                    'id'            => $c->Student->id_number,
                    'complete_name' => $c->Student->completeName(),
                    'term'          => $displaySemester
                ];

            });


            return view('student.dashboard.index')->with([
                'student' => (object)[
                    'complete_name' => $student->completeName()
                ],
                'classmates' => $classmates
            ]);

        }
    }
