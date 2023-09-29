<?php

    namespace App\Http\Controllers;

    use App\Http\Resources\AcademicTermResource;
    use App\Http\Resources\CourseResource;
    use App\Http\Resources\SubjectResource;
    use Domain\Modules\AcademicTerm\Repositories\IAcademicTermRepository;
    use Domain\Modules\Course\Repositories\ICourseRepository;
    use Domain\Modules\Student\Repositories\IStudentRepository;
    use Domain\Modules\Subject\Repositories\ISubjectRepository;
    use Error;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;

    class SubjectTermController extends Controller
    {

        protected IAcademicTermRepository $academicTermRepository;
        protected IStudentRepository $studentRepository;
        protected ICourseRepository $courseRepository;

        protected ISubjectRepository $subjectRepository;


        public function __construct(IAcademicTermRepository $academicTermRepository, IStudentRepository $studentRepository, ICourseRepository $courseRepository, ISubjectRepository $subjectRepository)
        {
            $this->academicTermRepository = $academicTermRepository;
            $this->studentRepository      = $studentRepository;
            $this->courseRepository       = $courseRepository;
            $this->subjectRepository      = $subjectRepository;
        }


        public function index()
        {
            return view('subject-term.index');
        }

        public function getData()
        {
            $terms = AcademicTermResource::collection(
                $this->academicTermRepository->GetAll()
            )->resolve();

            $courses = CourseResource::collection(
                $this->courseRepository->GetAll()
            )->resolve();

            $subjects = SubjectResource::collection(
                $this->subjectRepository->GetAll()
            )->resolve();

            $semesters = $this->academicTermRepository->GetSemesters();


            return response()->json([
                'data'    => [
                    'terms'      => $terms,
                    'semesters'  => $semesters,
                    'courses'    => $courses,
                    'year_level' => $this->studentRepository->GetYearLevel(),
                    'subjects'   => $subjects
                ],
                'success' => true
            ]);
        }

        public function store(Request $req)
        {

            try {
                $val = Validator::make($req->all(), [
                    'course'        => 'required',
                    'academic_term' => 'required',
                    'year_level'    => 'required',
                    'subject'       => 'required',
                    'semester'      => 'required'
                ]);

                if ($val->fails()) {
                    throw new Error($val->getMessageBag()->all()[0]);
                }

                $course_id        = $req->input('course');
                $academic_term_id = $req->input('academic_term');
                $year_level    = $req->input('year_level');
                $subject_id       = $req->input('subject');
                $semester      = $req->input('semester');


                $academic_semester = $this->academicTermRepository->FindAcademicSemester(
                    $academic_term_id,
                    $semester
                );


                $this->academicTermRepository->SaveSubjectTerm(
                    $academic_semester->id,
                    $course_id,
                    $subject_id,
                    $year_level
                );


                return $req->all();


            } catch (Error $error) {
                return redirectExceptionWithInput($error);
            }


        }
    }
