<?php
	
	namespace App\Http\Controllers;
	
	use App\Models\StudentAdmission;
	use App\Services\BaseDataDropDownService;
	use Domain\Modules\AcademicTerm\Repositories\IAcademicTermRepository;
	use Domain\Modules\Student\Repositories\IStudentRepository;
	use Error;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Validator;
	use Illuminate\View\View;
	
	class StudentAdmissionController extends Controller
	{
		protected BaseDataDropDownService $baseDataDropDownService;
		protected IAcademicTermRepository $academicTermRepository;
		protected IStudentRepository $studentRepository;
		
		/**
		 * @param BaseDataDropDownService $baseDataDropDownService
		 * @param IAcademicTermRepository $academicTermRepository
		 * @param IStudentRepository $studentRepository
		 */
		public function __construct(BaseDataDropDownService $baseDataDropDownService, IAcademicTermRepository $academicTermRepository, IStudentRepository $studentRepository)
		{
			$this->baseDataDropDownService = $baseDataDropDownService;
			$this->academicTermRepository  = $academicTermRepository;
			$this->studentRepository       = $studentRepository;
		}
		
		
		public function index(): View
		{
			return view('student-admission.index')->with([
				'admissions' => [],
				'paginate'   => ''
			]);
		}
		
		public function create()
		{
			$data = $this->baseDataDropDownService->getBaseData();
			
			$students = $this->baseDataDropDownService->students();
			
			
			return view('student-admission.create')->with([
				'students'   => $students,
				'subjects'   => $data->subjects,
				'terms'      => $data->terms,
				'semesters'  => $data->semesters,
				'courses'    => $data->courses,
				'year_level' => $data->year_level,
				'sections'   => $data->sections
			]);
		}
		
		
		public function store(Request $req)
		{
			try {
				$val = Validator::make($req->all(), [
					'academic_term' => 'required',
					'semester'      => 'required',
					'student'       => 'required',
					'course'        => 'required',
					'year_level'    => 'required',
					'section'       => 'required',
				]);
				
				if ($val->fails()) {
					return redirectWithInput($val);
				}
				
				$term = $this->academicTermRepository->FindAcademicSemester(
					$req->input('academic_term'),
					$req->input('semester')
				);
				
				if (!$term) throw new Error('Academic Term Not found!');
				
				$this->studentRepository->RegisterAdmission(
					$term->id, $req->input('student'),
					$req->input('course'),
					$req->input('year_level'),
					$req->input('section'),
				);
				
				return redirectWithAlert('/student-admission', [
					'alert-success' => 'Student Admission Save Successfully!'
				]);
				
			} catch (Error $error) {
				return redirectExceptionWithInput($error);
			}
			
			
		}
		
		
	}
