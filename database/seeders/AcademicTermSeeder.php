<?php
	
	namespace Database\Seeders;
	
	use App\Models\AcademicTerm;
	use App\Models\AcademicTermSemester;
	use Illuminate\Database\Seeder;
	
	class AcademicTermSeeder extends Seeder
	{
		/**
		 * Run the database seeds.
		 */
		public function run(): void
		{
			AcademicTerm::query()->delete();
			
			
			AcademicTermSemester::query()->delete();
			
			$a = AcademicTerm::factory()->create([
				'year_from' => 2020,
				'year_to'   => 2021,
			]);
			
			AcademicTermSemester::factory()->create([
				'academic_id' => $a->id,
				'semester'   => '1st',
				'is_current' => true
			]);
			AcademicTermSemester::factory()->create([
				'academic_id' => $a->id,
				'semester' => '2nd',
			]);
			
		}
	}
