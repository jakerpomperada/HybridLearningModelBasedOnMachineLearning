<?php

    namespace App\Http\Controllers;

    use App\Http\Resources\AcademicTermResource;
    use App\Http\Resources\CourseResource;
    use App\Http\Resources\SubjectResource;
    use Domain\Modules\AcademicTerm\Repositories\IAcademicTermRepository;
    use Domain\Modules\Course\Repositories\ICourseRepository;
    use Domain\Modules\Student\Repositories\IStudentRepository;
    use Domain\Modules\Subject\Repositories\ISubjectRepository;
    use Illuminate\Http\Request;

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
    }
