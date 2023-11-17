<?php
	
	namespace App\Http\Controllers\Admin;
	
	use App\Http\Controllers\Controller;
	use Domain\Modules\AcademicTerm\Repositories\IAcademicTermRepository;
	use Domain\Modules\Admission\Repositories\IAdmissionRepository;
	use Domain\Modules\Course\Repositories\ICourseRepository;
	use Domain\Modules\Student\Repositories\IStudentRepository;
	use Domain\Modules\Subject\Repositories\ISubjectRepository;
	use Domain\Modules\Teacher\Repositories\ITeacherRepository;
	use Domain\Shared\AcademicTerm;
	use Illuminate\Support\Facades\DB;
	use Illuminate\Support\Facades\Session;
	
	class DashboardAdminController extends Controller
	{
		
		protected IAcademicTermRepository $academicTermRepository;
		protected IStudentRepository $studentRepository;
		protected ITeacherRepository $teacherRepository;
		protected ICourseRepository $courseRepository;
		protected ISubjectRepository $subjectRepository;
		protected IAdmissionRepository $admissionRepository;
		
		
		public function __construct(IAcademicTermRepository $academicTermRepository, IStudentRepository $studentRepository, ITeacherRepository $teacherRepository, ICourseRepository $courseRepository, ISubjectRepository $subjectRepository, IAdmissionRepository $admissionRepository)
		{
			$this->academicTermRepository = $academicTermRepository;
			$this->studentRepository      = $studentRepository;
			$this->teacherRepository      = $teacherRepository;
			$this->courseRepository       = $courseRepository;
			$this->subjectRepository      = $subjectRepository;
			$this->admissionRepository    = $admissionRepository;
		}
		
		
		public function index()
		{
			
			
			$term               = $this->academicTermRepository->GetCurrentAcademicTerm();
			$number_of_students = $this->studentRepository->CountAll();
			$number_of_teachers = $this->teacherRepository->CountAll();
			
			$countAllStudentAdmission = $this->admissionRepository->CountAllStudentAdmission();
			
			
			$term = new AcademicTerm($term->year_from, $term->year_to, $term->semester);
			
			
			$data = (object) [
				'term'               => $term,
				'number_of_students' => $number_of_students,
				'number_of_teachers' => $number_of_teachers,
				'total_course'       => $this->courseRepository->CountAll(),
				'total_subjects'     => $this->subjectRepository->CountAll(),
				'admission'          => (object)[
					'firstYear'  => ($this->admissionRepository->CountAll1stYearStudents() / $countAllStudentAdmission) * 100,
					'secondYear'  => ($this->admissionRepository->CountAll2ndYearStudents() / $countAllStudentAdmission) * 100,
					'thirdYear'  => ($this->admissionRepository->CountAll3rdYearStudents() / $countAllStudentAdmission) * 100,
					'fourthYear' => ($this->admissionRepository->CountAll4rthYearStudents() / $countAllStudentAdmission) * 100,
				]
			
			];
		
		
			
			
			return view('admin.dashboard.index')->with([
				'role' => Session::get('role'),
				'term' => $term->getTerm() . " (" . $term->displaySemester() . ")",
				'data' => $data
			]);
		}
	}
