<?php

    namespace App\Http\Controllers;

    use App\Http\Resources\TeacherResource;
    use Domain\Modules\Teacher\Entities\Teacher;
    use Domain\Modules\Teacher\Repositories\ITeacherRepository;
    use Domain\Shared\Image;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Session;
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

            $data = $this->teacherRepository->GetAllPaginate(1, 5);

            $teachers = (new TeacherResource($data->items()))->data();

            return view('teacher.index')->with([
                'teachers' => $teachers,
                'paginate' => $data->links()
            ]);
        }

        public function create(): View
        {
            return view('teacher.create');
        }

        public function show($id): View
        {
            $d = $this->teacherRepository->Find($id);
            $t = new Teacher(
                $d->id_number,
                $d->firstname,
                $d->lastname,
                $d->middlename,
                $d->birthdate,
                $d->contact_number,
                $d->address,
                $d->id
            );
            $t->setImage(new Image($d->image));

            return view('teacher.edit')->with([
                'teacher' => (object)[
                    'id'             => $t->getId(),
                    'image_name'     => $t->getImage()->getImageName(),
                    'image_link'     => $t->getImage()->getImageLink(),
                    'id_number'      => $t->getIdNumber(),
                    'firstname'      => $t->getFirstname(),
                    'lastname'       => $t->getLastname(),
                    'middlename'     => $t->getMiddlename(),
                    'birthdate'      => $t->getBirthdate(),
                    'contact_number' => $t->getContactNumber(),
                    'address'        => $t->getAddress(),
                ]
            ]);
        }


        public function store(Request $req)
        {
            $val = Validator::make($req->all(), [
                'id_number'      => 'required',
                'image_name'     => 'required|string',
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

        public function update(Request $req, $id) {
            $val = Validator::make($req->all(), [
                'id_number'      => 'required',
                'image_name'     => 'required|string',
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
                $req->input('address'),
                $id
            );
            $teacher->setImage(new Image($req->input('image_name')));

            $this->teacherRepository->Update($teacher);

            return redirectWithAlert('/teacher', [
                'alert-info' => 'Teacher has been updated!'
            ]);
        }


        public function destroy(string $id) : JsonResponse {

            $this->teacherRepository->Delete($id);

            Session::flash('alert-danger', 'Teacher has been deleted');

            return response()->json([
                'success' => true
            ]);

        }


    }
