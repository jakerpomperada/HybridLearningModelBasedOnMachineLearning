<?php
	
	namespace App\Services;
	
	use Illuminate\Support\Facades\DB;
	
	class AdmissionService
	{
		
		
		
		public function CountAll1stYearStudent() : int {
			
			return DB::table('admission')->where([
				'year_level' => '1st'
			])->count();
			
		}
		
		public function CountAll2ndYearStudent() : int {
			return 1;
		}
		
		
		public function CountAll3rdYearStudent() : int {
			return 1;
		}
		
		public function CountAll4rthYearStudent() : int {
			return 1;
		}
		
	}