<?php

	namespace App\Http\Controllers\Student;

	use App\Http\Controllers\Controller;
	use App\Models\AcademicTermSubject;
	use App\Models\Admission;
	use App\Models\Student;
	use Domain\Modules\AcademicTerm\Repositories\IAcademicTermRepository;
	use Domain\Modules\Student\Repositories\IStudentRepository;
	use Illuminate\Support\Facades\Auth;
	use Illuminate\Support\Facades\DB;

	class SubjectTakenController extends Controller
	{
		protected IAcademicTermRepository $academicTermRepository;
		protected IStudentRepository $studentRepository;


		public function __construct(IAcademicTermRepository $academicTermRepository, IStudentRepository $studentRepository)
		{
			$this->academicTermRepository = $academicTermRepository;
			$this->studentRepository      = $studentRepository;
		}


		public function index()
		{

			$user_id               = Auth::id();
			$current_term_semester = $this->academicTermRepository->GetCurrentAcademicTerm();


			$student = $this->studentRepository->GetStudentInfoWithUserId($user_id);

			$admission = Admission::where('student_id', $student->id)->first();

			$subjects = [];

			if ($admission) {

				$terms_subjects = AcademicTermSubject::with(['Subject'])->where([
					'academic_term_semester_id' => $current_term_semester->id
				])->get();

				foreach ($terms_subjects as $terms_subject) {

					$teaching_load = DB::table('teaching_loads')->where([
						'subject_id'                => $terms_subject->subject_id,
						'academic_term_semester_id' => $terms_subject->academic_term_semester_id,
						'course_id'                 => $terms_subject->course_id
					])->first();

					if ($teaching_load) {
						$subjects[] = (object)[
							'id'                  => $terms_subject->id,
							'subject_code'        => $terms_subject->Subject->code,
							'subject_description' => $terms_subject->Subject->description,
							'teaching_load_id'       => $teaching_load->id
						];
					}


				}
			}


			return view('student.subject-taken.index')->with([
				'subjects' => $subjects
			]);
		}
	}
