<?php

	namespace App\Http\Controllers;

	use App\Http\Resources\StudentResource;
	use Domain\Modules\Student\Entities\Student;
	use Domain\Modules\Student\Repositories\IStudentRepository;
	use Domain\Modules\User\Entities\User;
	use Domain\Shared\Address;
	use Domain\Shared\Image;
	use Error;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Session;
	use Illuminate\Support\Facades\Validator;
	use Illuminate\View\View;

	class StudentController extends Controller
	{

		protected IStudentRepository $studentRepository;

		public function __construct(IStudentRepository $studentRepository)
		{
			$this->studentRepository = $studentRepository;
		}


		public function index()
		{
			$students_data = $this->studentRepository->GetAllPaginate(1, 5);

			$students_data_aggregates = collect($students_data->items())->map(function ($stud) {
				return $this->studentRepository->Aggregates($stud);
			});

			$students = StudentResource::collection($students_data_aggregates)->resolve();

			return view('admin.student.index')->with([
				'students' => $students,
				'paginate' => $students_data->links()
			]);
		}

		public function print() : View
		{
			$students_data = $this->studentRepository->GetAll();

			$students_data_aggregates = collect($students_data)->map(function ($stud) {
				return $this->studentRepository->Aggregates($stud);
			});

			$students = StudentResource::collection($students_data_aggregates)->resolve();


			return view('admin.student.print')->with([
				'students' => $students,
			]);

		}


		public function create()
		{
			return view('admin.student.create');
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
                'has_internet_connectivity' => 'required'
			]);

			if ($val->fails()) {
				return redirectWithInput($val);
			}


			$student = $this->setStudentAggregate($req);

			$this->studentRepository->Save($student);

			return redirectWithAlert('/student', [
				'alert-success' => 'New Student has been added!'
			]);
		}

		/**
		 * @param Request $req
		 * @return Student
		 */
		public function setStudentAggregate(Request $req, ?string $id = null): Student
		{
			$student = new Student(
				$req->input('id_number'),
				$req->input('firstname'),
				$req->input('middlename'),
				$req->input('lastname'),
				$req->input('birthdate'),
				$req->input('contact_number'),
				new Address($req->input('address')),
				$id
			);

			$student->setImage(new Image($req->input('image_name')));

			$student->setAccount(new User(
					$req->input('username'),
					$req->input('password'))
			);

            $student->setHasInternetConnectivity( $req->input('has_internet_connectivity') );


			return $student;
		}

		public function show(string $id): View
		{

			$student_data = $this->studentRepository->Find($id);
			$student      = (new StudentResource($student_data))->resolve();

			return view('admin.student.edit')->with([
				'student' => (object)$student
			]);
		}

		public function update(Request $req, $id)
		{
			try {
				$val = Validator::make($req->all(), [
					'id_number'      => 'required',
					'username'       => 'required',
					'image_name'     => 'required|string',
					'firstname'      => 'required',
					'middlename'     => 'required',
					'lastname'       => 'required',
					'birthdate'      => 'required',
					'contact_number' => 'required|numeric',
					'address'        => 'required',
                    'has_internet_connectivity' => 'required'
				]);

				if ($val->fails()) {
					throw new Error($val->getMessageBag()->all()[0]);
				}

				$student_data = $this->studentRepository->Find($id);

				if (!$student_data) new Error('Student not exists in Database');

				$student = $this->setStudentAggregate($req, $id);

				$this->studentRepository->Update($student, $student_data->getAccount()->getId());

				return redirectWithAlert('/student', [
					'alert-info' => 'Student has been updated!'
				]);

			} catch (Error $error) {
				return redirectExceptionWithInput($error);
			}


		}


		public function destroy(string $id)
		{
			$this->studentRepository->Delete($id);
			Session::flash('alert-danger', 'Student has been deleted');

			return response()->json([
				'success' => true
			]);
		}


	}
