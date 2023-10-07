<?php
	
	namespace App\Services;
	
	use App\Http\Resources\AcademicTermResource;
	use App\Http\Resources\CourseResource;
	use App\Http\Resources\SubjectResource;
	use Domain\Modules\AcademicTerm\Repositories\IAcademicTermRepository;
	use Domain\Modules\Course\Repositories\ICourseRepository;
	use Domain\Modules\Student\Repositories\IStudentRepository;
	use Domain\Modules\Subject\Repositories\ISubjectRepository;
	use Illuminate\Support\Collection;
	
	class BaseDataDropDownService
	{
		protected IAcademicTermRepository $academicTermRepository;
		protected IStudentRepository $studentRepository;
		protected ICourseRepository $courseRepository;
		
		protected ISubjectRepository $subjectRepository;
		
		
		public function __construct(IAcademicTermRepository $academicTermRepository, IStudentRepository $studentRepository, ICourseRepository $courseRepository, ISubjectRepository $subjectRepository)
		{
			$this->academicTermRepository = $academicTermRepository;
			$this->studentRepository      = $studentRepository;
			$this->courseRepository       = $courseRepository;
			$this->subjectRepository      = $subjectRepository;
		}
		
		
		public function getBaseData(): object
		{
			$terms = AcademicTermResource::collection(
				$this->academicTermRepository->GetAll()
			)->resolve();
			
			$courses = CourseResource::collection(
				$this->courseRepository->GetAll()
			)->resolve();
			
			$subjects = SubjectResource::collection(
				$this->subjectRepository->GetAll()
			)->resolve();
			
			$semesters = $this->academicTermRepository->GetSemesters();
			
			$year_level = $this->studentRepository->GetYearLevel();

//		--------------------- Terms ------------------------------------
			
			$terms = collect($terms)->mapWithKeys(function ($item, $key) {
				return [$item->id => $item->academic_year];
			});
			
			$courses = collect($courses)->mapWithKeys(function ($item, $key) {
				return [$item['id'] => $item['code']];
			});
			
			$subjects = collect($subjects)->mapWithKeys(function ($item, $key) {
				return [$item['id'] => $item['code']];
			});
			
			
			$semesters = collect($semesters)->mapWithKeys(function ($item, $key) {
				return [$key => $item];
			});
			$sections  = [
				'a' => 'A',
				'b' => 'B',
				'c' => 'C'
			];
			return (object)[
				'subject'    => $subjects,
				'terms'      => $terms,
				'semesters'  => $semesters,
				'courses'    => $courses,
				'year_level' => $year_level,
				'subjects'   => $subjects,
				'sections'   => $sections
			];
			
		}
		
		public function students(): Collection
		{
			$students = $this->studentRepository->GetAll();
			return $students->mapWithKeys(function ($item, $key) {
				$student = $this->studentRepository->Aggregates($item);
				return [$student->getId() => $student->completeName()];
			});
			
		}
		
	}