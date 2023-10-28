<?php
	
	namespace App\Http\Controllers\Teacher;
	
	use App\Http\Controllers\Controller;
	use App\Http\Resources\StudentResource;
	use App\Services\TeacherService;
	use Domain\Modules\Student\Repositories\IStudentRepository;
	use Domain\Modules\Teacher\Entities\ParticipationCategory;
	use Domain\Modules\Teacher\Entities\ParticipationScore;
	use Domain\Modules\Teacher\Repositories\ITeacherRepository;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Validator;
	
	class StudentParticipationController extends Controller
	{
		
		
		use TeacherControllerTrait;
		
		protected ITeacherRepository $teacherRepository;
		protected IStudentRepository $studentRepository;
		protected TeacherService $teacherService;
		
		
		public function __construct(ITeacherRepository $teacherRepository, IStudentRepository $studentRepository, TeacherService $teacherService)
		{
			$this->teacherRepository = $teacherRepository;
			$this->studentRepository = $studentRepository;
			$this->teacherService    = $teacherService;
		}
		
		
		public function index()
		{
			
			
			$subject_load_id = request()->input('subject_load');
			
			
			$subject_loads = $this->teacherService->getSubjectLoads($this->getTeacherId());
			
			if ($subject_load_id) {
				$student_attendance = $this->teacherRepository->GetAllStudentParticipationByTeachingLoadGroupByDate(
					$subject_load_id
				);
				
				$student_attendance = collect($student_attendance->items())->map(function ($i) use ($subject_load_id) {
					
					$data = $this->teacherRepository->GetAllStudentAttendanceFindByDate(
						$subject_load_id, $i->date
					);
					
					
					return (object)[
						'date'             => $i->date,
						'subject'          => $i->TeachingLoad->Subject->code,
						'year_section'     => $i->TeachingLoad->getYearSection(),
						'present'          => $i->countPresent($data),
						'absent'           => $i->countAbsent($data),
						'excuse'           => $i->countExcuse($data),
						'teaching_load_id' => $i->teaching_load_id
					];
				});
			} else {
				$student_attendance = [];
			}
			
			return view('teacher.student-participation.index')->with([
				'semester'            => $this->getCurrentTerm()->displaySemester(),
				'term'                => $this->getCurrentTerm()->getTerm(),
				'subject_loads'       => $subject_loads,
				'subject_load_id'     => $subject_load_id,
				'student_attendances' => $student_attendance
			]);
			
		}
		
		public function create()
		{
			$admissions = $this->studentRepository->GetAllAdmission();
			
			
			$students_data_aggregates = $admissions->map(function ($admission) {
				$student               = $this->studentRepository->Aggregates($admission->Student);
				$student->admission_id = $admission->id;
				return $student;
			});
			
			
			$students = StudentResource::collection($students_data_aggregates)->resolve();
			
			
			return view('teacher.student-participation.create')->with([
				'students'         => $students,
				'teaching_load_id' => request()->input('teaching_load_id')
			]);
		}
		
		public function store(Request $req)
		{
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
			
			$participation = new ParticipationCategory($req->input('date'), $req->input('points'), $req->input('title'));
			$this->teacherRepository->SaveStudentParticipationCategory($participation, $teaching_load_id);
			
			
			foreach ($req->input('scores') as $id => $score) {
								$this->teacherRepository->SaveStudentParticipationScore(
					new ParticipationScore($score), $participation->getId(), $id
				);
			}
			
			return redirectWithAlert('/teacher/student-participation?teaching_load_id=' . $teaching_load_id, [
				'alert-success' => 'Student Participation has been recorded successfully!'
			]);
			
		}
		
	}
