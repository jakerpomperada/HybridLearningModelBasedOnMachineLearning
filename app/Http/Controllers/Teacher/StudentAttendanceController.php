<?php
	
	namespace App\Http\Controllers\Teacher;
	
	use App\Http\Controllers\Controller;
	use Domain\Modules\Teacher\Repositories\ITeacherRepository;
	
	class StudentAttendanceController extends Controller
	{
		use TeacherControllerTrait;
		protected ITeacherRepository $teacherRepository;
		
		public function __construct(ITeacherRepository $teacherRepository)
		{
			$this->teacherRepository = $teacherRepository;
		}
		
		
		public function index() {
			
			$loading = $this->teacherRepository->GetAllTeachingLoads(
				$this->getTeacherId()
			);
			$subject_loads = $loading->mapWithKeys(function ($item, $i){
				return [
					$item->id => ''.$item->getSubjectCode().' ['.$item->getYearLevel().'-'.$item->getSection().']'
				];
			});
			
			
			return view('teacher.student-attendance.index')->with([
				'semester' => $this->getCurrentTerm()->displaySemester(),
				'term' => $this->getCurrentTerm()->getTerm(),
				'subject_loads' => $subject_loads
				
			]);
		
		}
	}