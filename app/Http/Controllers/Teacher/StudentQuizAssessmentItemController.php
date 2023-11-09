<?php
	
	namespace App\Http\Controllers\Teacher;
	
	use App\Http\Controllers\Controller;
	use App\Models\StudentQuizAssessment;
	use App\Models\StudentQuizAssessmentQuestion;
	use App\Repositories\TeacherRepository;
	use App\Services\TeacherService;
	use Domain\Modules\Assessment\Repositories\IAssessmentRepository;
	use Domain\Modules\Student\Repositories\IStudentRepository;
	use Illuminate\Http\Request;
	
	class StudentQuizAssessmentItemController extends Controller
	{
		
		use TeacherControllerTrait;
		
		protected IAssessmentRepository $assessmentRepository;
		protected TeacherService $teacherService;
		
		public function __construct(IAssessmentRepository $assessmentRepository, TeacherService $teacherService)
		{
			$this->assessmentRepository = $assessmentRepository;
			$this->teacherService       = $teacherService;
		}
		
		
		public function index()
		{
			$assessment_cat_id = request()->input('id');
			$subject_loads = $this->teacherService->getSubjectLoads($this->getTeacherId());
			
			$assessments = $this->assessmentRepository->GetAllQuizByCategoryPaginate(
				$assessment_cat_id, 5
			);
			
			return view('teacher.quiz-assessment-item.index')->with([
				'semester'               => $this->getCurrentTerm()->displaySemester(),
				'term'                   => $this->getCurrentTerm()->getTerm(),
			]);
		}
	}
