<?php
	
	namespace App\Http\Controllers\Teacher;
	
	use App\Http\Controllers\Controller;
	use App\Http\Resources\StudentResource;
	use App\Repositories\TeacherRepository;
	use App\Services\TeacherService;
	use Domain\Modules\Student\Repositories\IStudentRepository;
	use Domain\Modules\Teacher\Entities\QuizCategory;
	use Domain\Modules\Teacher\Entities\QuizScore;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Validator;
	
	class StudentQuizController extends Controller
	{
		
		
		use TeacherControllerTrait;
		
		protected TeacherService $teacherService;
		protected TeacherRepository $teacherRepository;
		protected IStudentRepository $studentRepository;
		
		
		public function __construct(TeacherService $teacherService, TeacherRepository $teacherRepository, IStudentRepository $studentRepository)
		{
			$this->teacherService    = $teacherService;
			$this->teacherRepository = $teacherRepository;
			$this->studentRepository = $studentRepository;
		}
		
		public function index()
		{
			
			$subject_load_id = request()->input('teaching_load_id');
			
			$subject_loads = $this->teacherService->getSubjectLoads($this->getTeacherId());
			
			if ($subject_load_id) {
				$student_quizzes = $this->teacherRepository->GetAllStudentQuizzesByTeachingLoadGroupByDate(
					$subject_load_id
				);
				$student_quizzes = collect($student_quizzes->items())->map(function ($i) use ($subject_load_id) {
					
					return (object)[
						'date'             => $i->displayDate(),
						'year_section'     => $i->TeachingLoad->getYearSection(),
						'subject'          => $i->TeachingLoad->Subject->code,
						'title'            => $i->title,
						'points'           => $i->points,
						'teaching_load_id' => $i->teaching_load_id
					];
				});
				
				
			} else {
				$student_quizzes = [];
			}
			
			return view('teacher.student-quiz.index')->with([
				'semester'               => $this->getCurrentTerm()->displaySemester(),
				'term'                   => $this->getCurrentTerm()->getTerm(),
				'subject_loads'          => $subject_loads,
				'subject_load_id'        => $subject_load_id,
				'student_quizzes' => $student_quizzes
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
			
			
			return view('teacher.student-quiz.create')->with([
				'students'         => $students,
				'teaching_load_id' => request()->input('teaching_load_id'),
				'load'        => (object)[
					'subject' => $teaching_load->getSubjectCode(),
					'year'    => $teaching_load->getYearLevel(),
					'section' => $teaching_load->getSection()
				]
			]);
		}
		
		public function store(Request $req) {
			$val = Validator::make($req->all(), [
				'date'     => 'required|date',
				'title'    => 'required',
				'points'   => 'required|numeric',
				'scores.*' => 'required'
			], [
				'scores.*.required' => 'Some scores cannot be empty!.'
			]);
			
			if ($val->fails()) {
				return redirectWithInput($val);
			}
			
			
			$teaching_load_id = $req->input('teaching_load_id');
			
			$task_performance = new QuizCategory($req->input('date'), $req->input('points'), $req->input('title'));
			$this->teacherRepository->SaveStudentQuizCategory($task_performance, $teaching_load_id);
			
			
			foreach ($req->input('scores') as $id => $score) {
				$this->teacherRepository->SaveStudentQuizScore(
					new QuizScore($score), $task_performance->getId(), $id
				);
			}
			
			return redirectWithAlert('/teacher/student-quiz?teaching_load_id=' . $teaching_load_id, [
				'alert-success' => 'Student Quizzes has been recorded successfully!'
			]);
			
			
			
			
			
			
		}
	}
