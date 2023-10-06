<?php
	
	namespace App\Http\Controllers;
	
	use App\Http\Resources\AcademicTermResource;
	use App\Http\Resources\CourseResource;
	use App\Http\Resources\SubjectResource;
	use Domain\Modules\AcademicTerm\Repositories\IAcademicTermRepository;
	use Domain\Modules\Course\Repositories\ICourseRepository;
	use Domain\Modules\Student\Repositories\IStudentRepository;
	use Domain\Modules\Subject\Repositories\ISubjectRepository;
	use Error;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Validator;
	
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
			
			$result = $this->academicTermRepository->GetAllSubjectTermPaginate(1, 5);
			
			$subjects = collect($result->items())->map(function ($i) {
				return (object)[
					'id'           => $i->id,
					'subject_code' => $i->Subject->code,
					'description'  => $i->Subject->description,
					'term'         => $i->AcademicTermSemester->getTerm(),
					'semester'     => $i->AcademicTermSemester->getSemester(),
					'course'       => $i->Course->code,
					'year'         => $i->getYearLevel()
				];
			});


//            Subject Code	Subject Description	Academic Term	Semester	Course	Year Level
			return view('subject-term.index')->with([
				'subjects' => $subjects,
				'paginate' => $result->links()
			]);
		}
		
		public function show($id)
		{
			
			$subject_term = $this->academicTermRepository->FindSubjectTerm($id);
			
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
			
			$year_level = $this->studentRepository->GetYearLevel();

//		--------------------- Terms ------------------------------------
			
			$terms = collect($terms)->mapWithKeys(function ($item, $key) {
				return [$item->id => $item->academic_year];
			});
			
			$courses = collect($courses)->mapWithKeys(function ($item, $key) {
				return [$item['id'] => $item['code']];
			});
			
			$subjects = collect($subjects)->mapWithKeys(function ($item, $key) {
				return [$item['id'] => $item['code']];
			});
			
			
			$semesters = collect($semesters)->mapWithKeys(function ($item, $key) {
				return [$key => $item];
			});
			
			
			return view('subject-term.edit')->with([
				'subject_term' => $subject_term,
				'subject'         => $subjects,
				'terms'           => $terms,
				'semesters'       => $semesters,
				'courses'         => $courses,
				'year_level'      => $year_level,
				'subjects'        => $subjects,
				'subject_term_id' => $id
			]);
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
		
		public function store(Request $req)
		{
			
			try {
				$val = Validator::make($req->all(), [
					'course'        => 'required',
					'academic_term' => 'required',
					'year_level'    => 'required',
					'subject'       => 'required',
					'semester'      => 'required'
				]);
				
				if ($val->fails()) {
					throw new Error($val->getMessageBag()->all()[0]);
				}
				
				$course_id        = $req->input('course');
				$academic_term_id = $req->input('academic_term');
				$year_level       = $req->input('year_level');
				$subject_id       = $req->input('subject');
				$semester         = $req->input('semester');
				
				
				$academic_semester = $this->academicTermRepository->FindAcademicSemester(
					$academic_term_id,
					$semester
				);
				
				
				$this->academicTermRepository->SaveSubjectTerm(
					$academic_semester->id,
					$course_id,
					$subject_id,
					$year_level
				);
				
				
				return $req->all();
				
				
			} catch (Error $error) {
				return redirectExceptionWithInput($error);
			}
			
			
		}
		
		public function update(Request $req, $id)
		{
			try {
				$val = Validator::make($req->all(), [
					'course'        => 'required',
					'academic_term' => 'required',
					'year_level'    => 'required',
					'subject'       => 'required',
					'semester'      => 'required'
				]);
				
				if ($val->fails()) {
					throw new Error($val->getMessageBag()->all()[0]);
				}
				
				
				$course_id        = $req->input('course');
				$academic_term_id = $req->input('academic_term');
				$year_level       = $req->input('year_level');
				$subject_id       = $req->input('subject');
				$semester         = $req->input('semester');
				
				
				$academic_semester = $this->academicTermRepository->FindAcademicSemester(
					$academic_term_id,
					$semester
				);
				
				
				$this->academicTermRepository->UpdateSubjectTerm(
					$academic_semester->id,
					$course_id,
					$subject_id,
					$year_level,
					$id
				);
				
				
				return redirectWithAlert('/subject-term', [
					'alert-info' => 'Subject Term has been updated!'
				]);
			
			} catch (Error $error) {
				return redirectExceptionWithInput($error);
			}
		}
	}
