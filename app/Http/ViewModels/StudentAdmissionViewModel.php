<?php
	
	namespace App\Http\ViewModels;
	
	use App\Models\Admission as StudentAdmissionDB;
	use Domain\Modules\Student\Entities\Student;
	use Domain\Modules\Student\ValueObjects\Course;
	use Domain\Modules\Student\ValueObjects\YearLevel;
	use Domain\Shared\AcademicTerm;
	use Domain\Shared\Address;
	
	class StudentAdmissionViewModel
	{
		
		protected StudentAdmissionDB $sa;
		protected Student $student;
		
		
		public function __construct(StudentAdmissionDB $studentAdmissionDB)
		{
			$this->sa = $studentAdmissionDB;
			
			$student  = $this->sa->Student;
			
			$this->student = new Student(
				$student->id_number,
				$student->firstname,
				$student->middlename,
				$student->lastname,
				$student->birthdate,
				$student->contact_number,
				new Address($student->address),
				$student->id
			);
			
			
			$this->student->setCurrentTerm(new AcademicTerm(
				$this->sa->AcademicTermSemester->AcademicTerm->year_from,
				$this->sa->AcademicTermSemester->AcademicTerm->year_to,
				$this->sa->AcademicTermSemester->semester
			));
			
			$this->student->setCurrentCourse(new Course(
				$this->sa->Course->code,
				$this->sa->Course->description
			));
			
			$this->student->setYearLevel(new YearLevel($this->sa->year_level, $this->sa->section));
			
			
			
		}
		
		public function id(): string
		{
			return $this->sa->id;
		}
		
		
		public function academic_term(): string
		{
			return $this->student->getCurrentTerm()->getTerm();
		}
		
		
		public function semester(): string
		{
			return $this->student->getCurrentTerm()->displaySemester();
		}
		
		public function student(): string
		{
			return $this->student->completeName();
		}
		
		public function course(): string
		{
			return $this->student->getCurrentCourse()->getCode();
		}
		
		public function yearSection(): string
		{
			return $this->student->getYearLevel()->getYearSection();
		}
	}