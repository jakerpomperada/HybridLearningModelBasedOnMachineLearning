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


        public function index() : View {
            $courses = $this->courseRepository->GetAllPaginate(1,5);

            return view('course.index')->with([
                'courses' => $courses->items(),
                'paginate' => $courses->links()
            ]);
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

        public function show(string $id): View {

            $course = $this->courseRepository->Find($id);

            return view('course.edit')->with([
                'course' => $course
            ]);
        }

        public function update(Request $req, string $id) : RedirectResponse {
            $val = Validator::make($req->all(), [
                'course_code' => 'required',
                'course_description' => 'required'
            ]);

            if ($val->fails()) {
                return redirectWithErrors($val);
            }

            $course = new Course(
                $req->input('course_code'),
                $req->input('course_description'),
                $id
            );

            $this->courseRepository->Update($course);

            return redirectWithAlert('/course', [
                'alert-info' => 'Course has been updated!'
            ]);


        }
    }
