<?php
	
	namespace App\Http\Controllers\Teacher;
	
	use App\Http\Controllers\Controller;
	use App\Http\Resources\StudentResource;
	use Domain\Modules\Student\Repositories\IStudentRepository;
	use Domain\Modules\Teacher\Repositories\ITeacherRepository;
	use Illuminate\Http\Request;
	
	class StudentAttendanceController extends Controller
	{
		use TeacherControllerTrait;
		
		protected ITeacherRepository $teacherRepository;
		protected IStudentRepository $studentRepository;
		
		/**
		 * @param ITeacherRepository $teacherRepository
		 * @param IStudentRepository $studentRepository
		 */
		public function __construct(ITeacherRepository $teacherRepository, IStudentRepository $studentRepository)
		{
			$this->teacherRepository = $teacherRepository;
			$this->studentRepository = $studentRepository;
		}
		
		public function index()
		{
			
			$loading       = $this->teacherRepository->GetAllTeachingLoads(
				$this->getTeacherId()
			);
			$subject_loads = $loading->mapWithKeys(function ($item, $i) {
				return [
					$item->id => '' . $item->getSubjectCode() . ' [' . $item->getYearLevel() . '-' . $item->getSection() . ']'
				];
			});
			
			return view('teacher.student-attendance.index')->with([
				'semester'      => $this->getCurrentTerm()->displaySemester(),
				'term'          => $this->getCurrentTerm()->getTerm(),
				'subject_loads' => $subject_loads,
				'subject_load_id' => request()->input('subject_load')
			]);
			
		}
		
		public function create() {
			$students = $this->studentRepository->GetAll();
			
			$students_data_aggregates = collect($students)->map( function ($stud) {
				return $this->studentRepository->Aggregates($stud);
			});
			
			$students = StudentResource::collection($students_data_aggregates)->resolve();
			
			return view('teacher.student-attendance.create')->with([
				'students' => $students
			]);
		}
		
		public function store(Request $req) {
				$req->dd();
		}
	}