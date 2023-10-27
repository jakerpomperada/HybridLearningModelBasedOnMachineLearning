<?php
	
	namespace App\Http\Controllers\Teacher;
	
	use App\Http\Controllers\Controller;
	use App\Http\Resources\StudentResource;
	use Domain\Modules\Student\Repositories\IStudentRepository;
	use Domain\Modules\Teacher\Repositories\ITeacherRepository;
	use Illuminate\Http\Request;
	use Error;
	use Illuminate\Support\Facades\Validator;
	
	class StudentAttendanceController extends Controller
	{
		use TeacherControllerTrait;
		
		protected ITeacherRepository $teacherRepository;
		protected IStudentRepository $studentRepository;
		
		/**
		 * @param ITeacherRepository $teacherRepository
		 * @param IStudentRepository $studentRepository
		 */
		public function __construct(ITeacherRepository $teacherRepository, IStudentRepository $studentRepository)
		{
			$this->teacherRepository = $teacherRepository;
			$this->studentRepository = $studentRepository;
		}
		
		public function index()
		{
			
			$subject_load_id = request()->input('subject_load');
			
			$loading       = $this->teacherRepository->GetAllTeachingLoads(
				$this->getTeacherId()
			);
			$subject_loads = $loading->mapWithKeys(function ($item, $i) {
				return [
					$item->id => '' . $item->getSubjectCode() . ' [' . $item->getYearLevel() . '-' . $item->getSection() . ']'
				];
			});
			
			if ($subject_load_id) {
				$student_attendance = $this->teacherRepository->GetAllStudentAttendanceGroupByDate(
					$subject_load_id
				);
				
				$student_attendance = collect($student_attendance->items())->map(function ($i) {
					
					$data = $this->teacherRepository->GetAllStudentAttendanceFindByDate(
						$i->teaching_load_id, $i->date
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
			
			
			return view('teacher.student-attendance.index')->with([
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
			
			
			return view('teacher.student-attendance.create')->with([
				'students'         => $students,
				'teaching_load_id' => request()->input('subject_load')
			]);
		}
		
		public function store(Request $req)
		{
			try {
				
				$date             = request()->input('date');
				$teaching_load_id = request()->input('teaching_load_id');
				
				
				$result = [];
				
				foreach ($req->status as $admission_id => $status) {
					$result[] = [
						'id'                   => uuid(),
						'date'                 => $date,
						'teaching_load_id'     => $teaching_load_id,
						'student_admission_id' => $admission_id,
						'status'               => $status['attendance'],
						'note'                 => $status['note'] ?? null,
						'created_at'           => now(),
						'updated_at'           => now(),
					];
				}
				
				
				$this->teacherRepository->SaveStudentAttendance($result);
				
				return redirectWithAlert('/teacher/student-attendance', [
					'alert-success' => 'New Attendance has been recorded!'
				]);
				
			} catch (Error $error) {
				return redirectExceptionWithInput($error);
			}
		}
		
		public function show()
		{
			
			$teaching_load_id = request()->input('teaching_load_id');
			$date             = request()->input('date');
			
			$student_attendances = $this->teacherRepository->showAllStudentAttendance(
				$teaching_load_id, $date
			);
			
			
			$students_data_aggregates = $student_attendances->map(function ($attendance) {
				$admission             = $attendance->StudentAdmission;
				$student               = $this->studentRepository->Aggregates($admission->Student);
				$student->admission_id = $admission->id;
				$student->attendance   = $attendance;
				return $student;
			});
			
			$students = StudentResource::collection($students_data_aggregates)->resolve();
			
			
			return view('teacher.student-attendance.edit')->with([
				'students'         => $students,
				'teaching_load_id' => $teaching_load_id,
				'date'             => $date
			]);
		}
		
		
		public function update(Request $req)
		{
//
				
				$date             = request()->input('date');
				$teaching_load_id = request()->input('teaching_load_id');
				
				
				$this->teacherRepository->DeleteStudentAttendance($teaching_load_id, $date);
				$result = [];
				
				foreach ($req->status as $admission_id => $status) {
					$result[] = [
						'id'                   => uuid(),
						'date'                 => $date,
						'teaching_load_id'     => $teaching_load_id,
						'student_admission_id' => $admission_id,
						'status'               => $status['attendance'],
						'note'                 => $status['note'] ?? null,
						'created_at'           => now(),
						'updated_at'           => now(),
					];
				}
				
				
				$this->teacherRepository->SaveStudentAttendance($result);
				
				
				
				return redirectWithAlert('/teacher/student-attendance?subject_load=' . $teaching_load_id, [
					'alert-success' => 'Attendance has been updated!'
				]);
			
		}
		
		
	}