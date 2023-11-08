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
		
		
		public function __construct(IAssessmentRepository $assessmentRepository)
		{
			$this->assessmentRepository = $assessmentRepository;
		}
		
		
		public function index()
		{
			$assessment_cat_id = request()->input('id');
			
			$assessments = $this->assessmentRepository->GetAllQuizByCategoryPaginate(
				$assessment_cat_id, 5
			);
			
			dd($assessments);
		}
	}
