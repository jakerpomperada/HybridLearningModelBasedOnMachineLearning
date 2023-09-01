<?php

    namespace App\Http\Controllers;

    use Domain\Modules\Course\Entities\Course;
    use Domain\Modules\Course\Repositories\ICourseRepository;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\View\View;

    class CourseController extends Controller
    {
        protected ICourseRepository $courseRepository;

        public function __construct(ICourseRepository $courseRepository)
        {
            $this->courseRepository = $courseRepository;
        }


        public function index() {
            $courses = $this->courseRepository->GetAllPaginate(1,10);

            return view('course.index');
        }

        public function create() : View {
            return view('course.create');
        }

        public function store(Request $req) : RedirectResponse {
            $val = Validator::make($req->all(), [
               'course_code' => 'required',
               'course_description' => 'required'
            ]);

            if ($val->fails()) {
                return redirectWithErrors($val);
            }

            $course = new Course(
                $req->input('course_code'),
                $req->input('course_description')
            );

            $this->courseRepository->Save($course);

            return redirectWithAlert('/course', [
                'alert-success' => 'New Course has been added!'
            ]);
        }
    }
