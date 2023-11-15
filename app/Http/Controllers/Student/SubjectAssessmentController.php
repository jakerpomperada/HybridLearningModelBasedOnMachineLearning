<?php
	
	namespace App\Http\Controllers\Student;
	
	use App\Http\Controllers\Controller;
	use Domain\Modules\Assessment\Repositories\IAssessmentRepository;
	use Illuminate\Http\Request;
	
	class SubjectAssessmentController extends Controller
	{
		protected IAssessmentRepository $assessmentRepository;
	
		public function __construct(IAssessmentRepository $assessmentRepository)
		{
			$this->assessmentRepository = $assessmentRepository;
		}
		
		
		public function index() {
			
		
		
//			$quizzes = $this->assessmentRepository->GetAllQuizByCategoryPaginate()
			
			
			return view('student.subject-assessment.index');
		}
	}
