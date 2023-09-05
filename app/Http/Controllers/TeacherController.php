<?php

    namespace App\Http\Controllers;

    use Domain\Modules\Teacher\Entities\Teacher;
    use Domain\Modules\Teacher\Repositories\ITeacherRepository;
    use Domain\Shared\Image;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\View\View;

    class TeacherController extends Controller
    {

        protected ITeacherRepository $teacherRepository;

        public function __construct(ITeacherRepository $teacherRepository)
        {
            $this->teacherRepository = $teacherRepository;
        }


        public function index(): View
        {
            $teachers = [];

            return view('teacher.index')->with([
                'teachers' => $teachers,
                'paginate' => ''
            ]);
        }

        public function create(): View
        {
            return view('teacher.create');
        }


        public function store(Request $req)
        {
            $val = Validator::make($req->all(), [
                'id_number'      => 'required',
                'image_name'      => 'required|string',
                'firstname'      => 'required',
                'middlename'     => 'required',
                'lastname'       => 'required',
                'birthdate'      => 'required',
                'contact_number' => 'required|numeric',
                'address'        => 'required',
            ]);

            if ($val->fails()) {
                return redirectWithInput($val);
            }


            $teacher = new Teacher(
                $req->input('id_number'),
                $req->input('firstname'),
                $req->input('middlename'),
                $req->input('lastname'),
                $req->input('birthdate'),
                $req->input('contact_number'),
                $req->input('address')
            );
            $teacher->setImage(new Image($req->input('image_name')));

            $this->teacherRepository->Save($teacher);

            return redirectWithAlert('/teacher', [
                'alert-success' => 'New Teacher has been added!'
            ]);

        }


    }
