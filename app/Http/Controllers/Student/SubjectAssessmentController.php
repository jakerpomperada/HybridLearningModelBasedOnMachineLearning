<?php
	
	namespace App\Http\Controllers\Student;
	
	use App\Http\Controllers\Controller;
	use Domain\Modules\Assessment\Repositories\IAssessmentRepository;
	use Domain\Modules\Student\Repositories\IStudentRepository;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Auth;
	
	class SubjectAssessmentController extends Controller
	{
		protected IAssessmentRepository $assessmentRepository;
		protected IStudentRepository $studentRepository;
		
		
		public function __construct(IAssessmentRepository $assessmentRepository, IStudentRepository $studentRepository)
		{
			$this->assessmentRepository = $assessmentRepository;
			$this->studentRepository    = $studentRepository;
		}
		
		
		public function index()
		{
			
			$teaching_load_id = request()->input('teaching_load_id');
			$student          = $this->studentRepository->FindByUserId(Auth::id());
			
			$quiz_assessments_data = $this->assessmentRepository->GetQuizAssessmentCategory(
				$teaching_load_id, 5
			);
			
			$quiz_assessments = collect($quiz_assessments_data->items())->map(function ($i) use ($student) {
				return (object)[
					'start_date'  => $i->displayDateStartDate(),
					'end_date'    => $i->displayDateEndDate(),
					'title'       => $i->getTitle(),
					'total_items' => $i->getTotalItems(),
					'scores'      => $i->getStudentScores($student->id),
					'status'      => $i->studentStatus($student->id)
				];
			});
			
			
			$exam_assessments_data = $this->assessmentRepository->GetExamAssessmentCategory(
				$teaching_load_id, 5
			);
			
			$exam_assessments = collect($exam_assessments_data->items())->map(function ($i) use ($student) {
				return (object)[
					'start_date'  => $i->displayDateStartDate(),
					'end_date'    => $i->displayDateEndDate(),
					'term'        => $i->getTerm(),
					'total_items' => $i->getTotalItems(),
					'scores'      => $i->getStudentScores($student->id),
					'status'      => $i->studentStatus($student->id)
				];
			});
			
			
			
			
			return view('student.subject-assessment.index')->with([
				'quiz_assessments' => $quiz_assessments,
				'exam_assessments' => $exam_assessments,
			]);
		}
	}
