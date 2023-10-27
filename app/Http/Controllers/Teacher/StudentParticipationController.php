<?php
	
	namespace App\Http\Controllers\Teacher;
	
	use App\Http\Controllers\Controller;
	use App\Services\TeacherService;
	use Domain\Modules\Student\Repositories\IStudentRepository;
	use Domain\Modules\Teacher\Repositories\ITeacherRepository;
	
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
				$student_attendance = $this->teacherRepository->GetAllStudentParticipationGroupByDate(
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
		
	}
