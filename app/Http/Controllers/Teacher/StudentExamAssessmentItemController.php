<?php
	
	namespace App\Http\Controllers\Teacher;
	
	use App\Http\Controllers\Controller;
	use App\Services\TeacherService;
	use Domain\Modules\Assessment\Repositories\IAssessmentRepository;
	use Domain\Modules\Teacher\Entities\ExamAssessmentChoice;
	use Domain\Modules\Teacher\Entities\ExamAssessmentQuestion;
	use Domain\Modules\Teacher\Entities\QuizAssessmentChoice;
	use Domain\Modules\Teacher\Entities\QuizAssessmentQuestion;
	use Illuminate\Http\RedirectResponse;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Validator;
	use Error;
	use Illuminate\View\View;
	
	class StudentExamAssessmentItemController extends Controller
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
			
			$assessment_items    = $this->assessmentRepository->GetAllExamByCategoryPaginate(
				$assessment_cat_id, 5
			);
			$assessment_category = $this->assessmentRepository->FindExamAssessmentCategory(
				$assessment_cat_id
			);
			
			$assessment_items = collect($assessment_items->items())->map(function ($ass) {
				return (object)[
					'id'             => $ass->id,
					'question'       => $ass->question,
					'correct_answer' => $ass->getCorrectAnswer()
				];
			});
			
			
			return view('teacher.exam-assessment-item.index')->with([
				'semester'      => $this->getCurrentTerm()->displaySemester(),
				'term'          => $this->getCurrentTerm()->getTerm(),
				'qacategory_id' => $assessment_cat_id,
				'assessments'   => $assessment_items,
				'category'      => $assessment_category
			]);
		}
		
		public function create()
		{
			$qacategory_id = request()->input('qacategory_id');
			
			return view('teacher.exam-assessment-item.create')->with([
				'choices'       => QuizAssessmentChoice::choices(),
				'qacategory_id' => $qacategory_id
			]);
		}
		
		public function store(Request $req): View|RedirectResponse
		{
			try {
				$val = Validator::make($req->all(), [
					'question'  => 'required',
					'choices.*' => 'sometimes|string|nullable',
					'answer'    => 'required'
				]);
				
				if ($val->fails()) {
					return redirectWithInput($val);
				}
				
				$answer        = $req->input('answer');
				$choices       = $req->input('choices');
				$question      = $req->input('question');
				$eacategory_id = $req->input('qacategory_id');
				
				$question = new ExamAssessmentQuestion($question);
				
				collect($choices)->map(function ($choice, $i) use ($answer, $question) {
					$is_answer = false;
					if ($i == $answer) $is_answer = true;
					if (empty($choice) && $is_answer) {
						throw new Error('The correct answer is empty');
					}
					
					if (!empty($choice)) {
						$question->setChoices(new ExamAssessmentChoice($i, $choice, $is_answer));
					}
				});
				
				$this->assessmentRepository->SaveExamAssessmentQuestions($question, $eacategory_id);
				
				return redirectWithAlert('/teacher/student-exam-assessment-items?id=' . $eacategory_id, [
					'alert-success' => 'Assessment Item has been  recorded successfully!'
				]);
				
				
			} catch (Error $error) {
				return redirectExceptionWithInput($error);
			}
			
		}
		
		
		public function show($id): View
		{
			
			$ass = $this->assessmentRepository->FindExamAssessmentQuestion($id);
			
			$questions = (object)[
				'id'      => $ass->id,
				'title'   => $ass->question,
				'choices' => $ass->StudentExamAssessmentChoice->map(function ($c) {
					return (object)[
						'id'         => $c->id,
						'order'      => $c->order,
						'choice'     => $c->choice,
						'is_correct' => $c->is_correct,
						'letter'     => $c->letter(),
					];
				})->sortBy('order')
			];
			
			$qacategory_id = request()->input('seaquestion_id');
			
			return view('teacher.exam-assessment-item.edit')->with([
				'choices'       => QuizAssessmentChoice::choices(),
				'qacategory_id' => $qacategory_id,
				'questions'     => $questions,
				'ass'           => $ass
			]);
		}
		
		
		public function update(Request $req, $id) {
			
			try {
				$val = Validator::make($req->all(), [
					'title'     => 'required',
					'choices.*' => 'sometimes|string|nullable',
					'answer'    => 'required'
				]);
				
				if ($val->fails()) {
					return redirectWithInput($val);
				}
				
				$ass = $this->assessmentRepository->FindExamAssessmentQuestion($id);
				
				$answer        = $req->input('answer');
				$choices       = $req->input('choices');
				$question      = $req->input('title');
				$qacategory_id = $ass->eacategory_id;
			
				
				$question = new ExamAssessmentQuestion($question);
				
				collect($choices)->map(function ($choice, $i) use ($answer, $question) {
					$is_answer = false;
					if ($i == $answer) $is_answer = true;
					if (empty($choice) && $is_answer) {
						throw new Error('The correct answer is empty');
					}
					
					if (!empty($choice)) {
						$question->setChoices(new ExamAssessmentChoice($i, $choice, $is_answer));
					}
				});
				
				$this->assessmentRepository->UpdateExamAssessmentQuestions($question, $id);
				
				return redirectWithAlert('/teacher/student-exam-assessment-items?id=' . $qacategory_id, [
					'alert-info' => 'Assessment Item has been updated successfully!'
				]);
				
				
			} catch (Error $error) {
				return redirectExceptionWithInput($error);
			}
		}
		
		
		
	}
