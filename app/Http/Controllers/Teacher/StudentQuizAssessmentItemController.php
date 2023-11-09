<?php
	
	namespace App\Http\Controllers\Teacher;
	
	use App\Http\Controllers\Controller;
	use App\Models\StudentQuizAssessment;
	use App\Models\StudentQuizAssessmentQuestion;
	use App\Repositories\TeacherRepository;
	use App\Services\TeacherService;
	use Domain\Modules\Assessment\Repositories\IAssessmentRepository;
	use Domain\Modules\Student\Repositories\IStudentRepository;
	use Domain\Modules\Teacher\Entities\QuizAssessmentCategory;
	use Domain\Modules\Teacher\Entities\QuizAssessmentChoice;
	use Domain\Modules\Teacher\Entities\QuizAssessmentQuestion;
	use Error;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Validator;
	
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
			
			$assessments = $this->assessmentRepository->GetAllQuizByCategoryPaginate(
				$assessment_cat_id, 5
			);
			
			$assessments = collect($assessments->items())->map(function ($ass) {
				return (object)[
					'id'             => $ass->id,
					'question'       => $ass->question,
					'correct_answer' => $ass->getCorrectAnswer()
				];
			});
			
			
			return view('teacher.quiz-assessment-item.index')->with([
				'semester'      => $this->getCurrentTerm()->displaySemester(),
				'term'          => $this->getCurrentTerm()->getTerm(),
				'qacategory_id' => $assessment_cat_id,
				'assessments'   => $assessments
			]);
		}
		
		
		public function create()
		{
			$qacategory_id = request()->input('qacategory_id');
			
			return view('teacher.quiz-assessment-item.create')->with([
				'choices'       => QuizAssessmentChoice::choices(),
				'qacategory_id' => $qacategory_id
			]);
		}
		
		public function store(Request $req)
		{
			
			try {
				$val = Validator::make($req->all(), [
					'title'     => 'required',
					'choices.*' => 'sometimes|string|nullable',
					'answer'    => 'required'
				]);
				
				if ($val->fails()) {
					return redirectWithInput($val);
				}
				
				$answer        = $req->input('answer');
				$choices       = $req->input('choices');
				$question      = $req->input('title');
				$qacategory_id = $req->input('qacategory_id');
				
				$question = new QuizAssessmentQuestion($question);
				
				collect($choices)->map(function ($choice, $i) use ($answer, $question) {
					$is_answer = false;
					if ($i == $answer) $is_answer = true;
					if (empty($choice) && $is_answer) {
						throw new Error('The correct answer is empty');
					}
					
					if (!empty($choice)) {
						$question->setChoices(new QuizAssessmentChoice($i, $choice, $is_answer));
					}
				});
				
				$this->assessmentRepository->SaveQuizAssessmentQuestions($question, $qacategory_id);
				
				return redirectWithAlert('/teacher/student-quiz-assessment-items?id=' . $qacategory_id, [
					'alert-success' => 'Student Quizzes has been recorded successfully!'
				]);
				
				
			} catch (Error $error) {
				return redirectExceptionWithInput($error);
			}
			
			
		}
		
		
	}
