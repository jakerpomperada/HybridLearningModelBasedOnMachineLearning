<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Services\TeacherService;
use Domain\Modules\Student\Repositories\IStudentRepository;
use Domain\Modules\Teacher\Repositories\ITeacherRepository;
use Illuminate\Http\Request;

class StudentQuizAssessmentController extends Controller
{
	
	use TeacherControllerTrait;
	
	protected TeacherService $teacherService;
	protected ITeacherRepository $teacherRepository;
	protected IStudentRepository $studentRepository;
	
	
	public function __construct(TeacherService $teacherService, ITeacherRepository $teacherRepository, IStudentRepository $studentRepository)
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
			$student_quizzes = $this->teacherRepository->GetAllStudentExamsByTeachingLoadGroupByDate(
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
		
		return view('teacher.quiz-assessment.index')->with([
			'semester'               => $this->getCurrentTerm()->displaySemester(),
			'term'                   => $this->getCurrentTerm()->getTerm(),
			'subject_loads'          => $subject_loads,
			'subject_load_id'        => $subject_load_id,
			'student_quizzes' => $student_quizzes
		]);
		
		
	}
	
	
}
