<?php
	
	namespace App\Http\Controllers;
	
	use App\Http\ViewModels\StudentAdmissionViewModel;
	use App\Services\BaseDataDropDownService;
	use Domain\Modules\AcademicTerm\Repositories\IAcademicTermRepository;
	use Domain\Modules\Student\Repositories\IStudentRepository;
	use Error;
	use Illuminate\Http\RedirectResponse;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Session;
	use Illuminate\Support\Facades\Validator;
	use Illuminate\View\View;
	
	class StudentAdmissionController extends Controller
	{
		protected BaseDataDropDownService $baseDataDropDownService;
		protected IAcademicTermRepository $academicTermRepository;
		protected IStudentRepository $studentRepository;
		
		
		public function __construct(BaseDataDropDownService $baseDataDropDownService, IAcademicTermRepository $academicTermRepository, IStudentRepository $studentRepository)
		{
			$this->baseDataDropDownService = $baseDataDropDownService;
			$this->academicTermRepository  = $academicTermRepository;
			$this->studentRepository       = $studentRepository;
		}
		
		
		public function index(): View
		{
			$student_admissions_data = $this->academicTermRepository->GetAllStudentAdmission();
			$student_admissions      = collect($student_admissions_data->items())->map(function ($data) {
				
				$sa = new StudentAdmissionViewModel($data);
				return (object)[
					'id'            => $sa->id(),
					'student_name'  => $sa->student(),
					'course'        => $sa->course(),
					'year_section'  => $sa->yearSection(),
					'academic_term' => $sa->academic_term(),
					'semester'      => $sa->semester(),
				];
			});
			
			
			return view('admin.student-admission.index')->with([
				'student_admissions' => $student_admissions,
				'paginate'           => $student_admissions_data->links()
			]);
		}
		
		public function create()
		{
			$data = $this->baseDataDropDownService->getBaseData();
			
			$students = $this->baseDataDropDownService->students();
			return view('admin.student-admission.create')->with([
				'students'   => $students,
				'subjects'   => $data->subjects,
				'terms'      => $data->terms,
				'semesters'  => $data->semesters,
				'courses'    => $data->courses,
				'year_level' => $data->year_level,
				'sections'   => $data->sections
			]);
		}
		
		
		public function store(Request $req): RedirectResponse
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
				
				$term_semester = $this->academicTermRepository->FindAcademicSemester(
					$req->input('academic_term'),
					$req->input('semester')
				);
				
				if (!$term_semester) throw new Error('Academic Semester Term Not found!');
				
				$this->studentRepository->RegisterAdmission(
					$term_semester->id,
					$req->input('student'),
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
		
		public function update(Request $req, string $id): RedirectResponse
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
				
				$term_semester = $this->academicTermRepository->FindAcademicSemester(
					$req->input('academic_term'),
					$req->input('semester')
				);
				
				if (!$term_semester) throw new Error('Academic Semester Term Not found!');
				
				$this->studentRepository->UpdateAdmission(
					$term_semester->id,
					$req->input('student'),
					$req->input('course'),
					$req->input('year_level'),
					$req->input('section'),
					$id
				);
				
				return redirectWithAlert('/student-admission', [
					'alert-info' => 'Student Admission Updated Successfully!'
				]);
				
			} catch (Error $error) {
				return redirectExceptionWithInput($error);
			}
			
			
		}
		
		public function show(string $id)
		{
			
			$admission = $this->studentRepository->FindAdmissionData($id);
			
			
			$data = $this->baseDataDropDownService->getBaseData();
			
			$students = $this->baseDataDropDownService->students();
			
			return view('admin.student-admission.edit')->with([
				'admission'  => (object)[
					'id'                        => $admission->id,
					'academic_term_semester_id' => $admission->academic_term_semester_id,
					'student_id'                => $admission->student_id,
					'course_id'                 => $admission->course_id,
					'year_level'                => $admission->year_level,
					'section'                   => $admission->section,
					'semester'                  => $admission->AcademicTermSemester->semester,
					'academic_term_id'          => $admission->AcademicTermSemester->AcademicTerm->id
				],
				'students'   => $students,
				'subjects'   => $data->subjects,
				'terms'      => $data->terms,
				'semesters'  => $data->semesters,
				'courses'    => $data->courses,
				'year_level' => $data->year_level,
				'sections'   => $data->sections
			]);
		}
		
		public function destroy(string $id) {
			
			$this->studentRepository->RemoveAdmission($id);
			
			Session::flash('alert-danger', 'Student has been deleted');
			
			return response()->json([
				'success' => true
			]);
		}
		
		
	}
