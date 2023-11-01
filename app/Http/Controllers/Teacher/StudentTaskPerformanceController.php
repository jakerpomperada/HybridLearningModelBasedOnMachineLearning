<?php
	
	namespace App\Http\Controllers\Teacher;
	
	use App\Http\Controllers\Controller;
	use App\Repositories\TeacherRepository;
	use App\Services\TeacherService;
	
	class StudentTaskPerformanceController extends Controller
	{
		use TeacherControllerTrait;
		protected TeacherService $teacherService;
		protected TeacherRepository $teacherRepository;
	
		public function __construct(TeacherService $teacherService, TeacherRepository $teacherRepository)
		{
			$this->teacherService    = $teacherService;
			$this->teacherRepository = $teacherRepository;
		}
		
		
		public function index()  {
			
			$subject_load_id = request()->input('teaching_load_id');
			
			$subject_loads = $this->teacherService->getSubjectLoads($this->getTeacherId());
			
			if ($subject_load_id) {
				$student_task_performance = $this->teacherRepository->GetAllStudentTaskPerformanceByTeachingLoadGroupByDate(
					$subject_load_id
				);
				$student_task_performance = collect($student_task_performance->items())->map(function ($i) use ($subject_load_id) {
					
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
				$student_task_performance = [];
			}
			
			
			return view('teacher.student-task_performance.index')->with([
				'semester'               => $this->getCurrentTerm()->displaySemester(),
				'term'                   => $this->getCurrentTerm()->getTerm(),
				'subject_loads'          => $subject_loads,
				'subject_load_id'        => $subject_load_id,
				'student_participations' => $student_task_performance
			]);
		}
	}