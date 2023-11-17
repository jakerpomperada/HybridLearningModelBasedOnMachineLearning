<?php
	
	namespace App\Repositories;
	
	use Domain\Modules\Admission\Repositories\IAdmissionRepository;
	use Illuminate\Support\Facades\DB;
	
	class AdmissionRepository implements IAdmissionRepository
	{
		
		public function CountAll1stYearStudents(): int
		{
			return DB::table('admissions')->where([
				'year_level' => '1st'
			])->count();
			
		}
		
		public function CountAll2ndYearStudents(): int
		{
			return DB::table('admissions')->where([
				'year_level' => '2nd'
			])->count();
		}
		
		public function CountAll3rdYearStudents(): int
		{
			return DB::table('admissions')->where([
				'year_level' => '3rd'
			])->count();
		}
		
		public function CountAll4rthYearStudents(): int
		{
			return DB::table('admissions')->where([
				'year_level' => '4rth'
			])->count();
		}
		
		public function CountAllStudentAdmission(): int
		{
			return DB::table('admissions')->count();
		}
		
		
	}