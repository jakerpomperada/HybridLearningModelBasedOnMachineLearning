<?php
	
	namespace App\Http\Controllers\Teacher;
	
	use App\Http\Controllers\Controller;
	use App\Http\Resources\StudentResource;
	use App\Services\TeacherService;
	use Domain\Modules\Assessment\Entities\ExamAssessmentCategory;
	use Domain\Modules\Assessment\Repositories\IAssessmentRepository;
	use Domain\Modules\Student\Repositories\IStudentRepository;
	use Domain\Modules\Teacher\Entities\QuizAssessmentCategory;
	use Domain\Modules\Teacher\Repositories\ITeacherRepository;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Validator;
	
	class StudentExamAssessmentController extends Controller
	{
		
		use TeacherControllerTrait;
		
		protected TeacherService $teacherService;
		protected ITeacherRepository $teacherRepository;
		protected IStudentRepository $studentRepository;
		protected IAssessmentRepository $assessmentRepository;
		
		
		public function __construct(TeacherService $teacherService, ITeacherRepository $teacherRepository, IStudentRepository $studentRepository, IAssessmentRepository $assessmentRepository)
		{
			$this->teacherService       = $teacherService;
			$this->teacherRepository    = $teacherRepository;
			$this->studentRepository    = $studentRepository;
			$this->assessmentRepository = $assessmentRepository;
		}
		
		
		public function index()
		{
			
			$subject_load_id = request()->input('teaching_load_id');
			
			$subject_loads = $this->teacherService->getSubjectLoads($this->getTeacherId());
			
			if ($subject_load_id) {
				$exam_assessment = $this->assessmentRepository->GetExamAssessmentCategory(
					$subject_load_id, 5
				);
				
				$exam_assessment = collect($exam_assessment->items())->map(function ($i) use ($subject_load_id) {
					return (object)[
						'id'               => $i->id,
						'start_date'       => $i->displayDateStartDate(),
						'end_date'         => $i->displayDateEndDate(),
						'term'            => $i->getTerm(),
						'teaching_load_id' => $i->teaching_load_id,
						'status'           => $i->getStatus(),
						'total_items'      => 1,
					];
				});
			} else {
				$exam_assessment = [];
			}
			
			
			
			return view('teacher.exam-assessment.index')->with([
				'semester'        => $this->getCurrentTerm()->displaySemester(),
				'term'            => $this->getCurrentTerm()->getTerm(),
				'subject_loads'   => $subject_loads,
				'subject_load_id' => $subject_load_id,
				'exam_assessment' => $exam_assessment
			]);
			
		}
		
		public function create()
		{
			$teaching_load_id = request()->input('teaching_load_id');
			
			$admissions = $this->studentRepository->GetAllAdmission();
			
			$teaching_load = $this->teacherRepository->FindTeachingLoad($teaching_load_id);
			
			$students_data_aggregates = $admissions->map(function ($admission) {
				$student               = $this->studentRepository->Aggregates($admission->Student);
				$student->admission_id = $admission->id;
				return $student;
			});
			
			$students = StudentResource::collection($students_data_aggregates)->resolve();
			
			
			return view('teacher.exam-assessment.create')->with([
				'students'         => $students,
				'teaching_load_id' => request()->input('teaching_load_id'),
				'load'             => (object)[
					'subject' => $teaching_load->getSubjectCode(),
					'year'    => $teaching_load->getYearLevel(),
					'section' => $teaching_load->getSection()
				]
			]);
		}
		
		public function store(Request $req)
		{
			$val = Validator::make($req->all(), [
				'date_start'       => 'required|date',
				'date_end'         => 'required|date',
				'term'             => 'required',
				'teaching_load_id' => 'required|string'
			]);
			
			if ($val->fails()) {
				return redirectWithInput($val);
			}
			
			$teaching_load_id = $req->input('teaching_load_id');
			
			$exam_assessment_cat = new ExamAssessmentCategory(
				$req->input('date_start'),
				$req->input('date_end'),
				$req->input('term'),
				'ungive'
			);
			$this->assessmentRepository->SaveExamAssessmentCategory($exam_assessment_cat, $teaching_load_id);
			
			
			return redirectWithAlert('/teacher/student-exam-assessment?teaching_load_id=' . $teaching_load_id, [
				'alert-success' => 'New Student Quiz Assessment has been added!'
			]);
		}
		
	}
