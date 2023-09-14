<?php

    namespace App\Http\Controllers;

    use Domain\Modules\Student\Entities\Student;
    use Domain\Modules\Student\Repositories\IStudentRepository;
    use Domain\Shared\Image;
    use Domain\Shared\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\View\View;

    class StudentController extends Controller
    {

        protected IStudentRepository $studentRepository;

        public function __construct(IStudentRepository $studentRepository)
        {
            $this->studentRepository = $studentRepository;
        }


        public function index(): View
        {
            return view('student.index')->with([
                'students' => [],
                'paginate' => ''
            ]);
        }

        public function create()
        {
            return view('student.create');
        }

        public function store(Request $req)
        {

            $val = Validator::make($req->all(), [
                'id_number'        => 'required',
                'username'         => 'required',
                'password'         => 'required',
                'confirm_password' => 'required|required_with:confirm_password|same:confirm_password',
                'image_name'       => 'required|string',
                'firstname'        => 'required',
                'middlename'       => 'required',
                'lastname'         => 'required',
                'birthdate'        => 'required',
                'contact_number'   => 'required|numeric',
                'address'          => 'required',
            ]);

            if ($val->fails()) {
                return redirectWithInput($val);
            }



            $student = new Student(
                $req->input('id_number'),
                $req->input('firstname'),
                $req->input('middlename'),
                $req->input('lastname'),
                $req->input('birthdate'),
                $req->input('contact_number'),
                $req->input('address')
            );

            $student->setImage(new Image($req->input('image_name')));

            $student->setAccount(new User(
                $req->input('username'),
                $req->input('password'))
            );


            $this->studentRepository->Save($student);

            return redirectWithAlert('/student', [
                'alert-success' => 'New Student has been added!'
            ]);
        }
    }
