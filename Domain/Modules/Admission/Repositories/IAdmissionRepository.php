<?php
	
	namespace Domain\Modules\Admission\Repositories;
	
	interface IAdmissionRepository
	{
		
		public function CountAll1stYearStudents(): int;
		
		public function CountAll2ndYearStudents(): int;
		
		public function CountAll3rdYearStudents(): int;
		
		public function CountAll4rthYearStudents(): int;
		
		public function CountAllStudentAdmission()  : int;
		
	}