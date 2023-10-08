<?php
	
	namespace Database\Seeders;
	
	use App\Models\AcademicTerm;
	use App\Models\AcademicTermSemester;
	use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
				'semester' => '1st',
			]);
			AcademicTermSemester::factory()->create([
				'academic_id' => $a->id,
				'semester' => '2nd',
			]);
			
			
			$b = AcademicTerm::factory()->create([
				'year_from' => 2021,
				'year_to'   => 2022,
			]);
			AcademicTermSemester::factory()->create([
				'academic_id' => $b->id,
				'semester' => '1st',
			]);
			AcademicTermSemester::factory()->create([
				'academic_id' => $b->id,
				'semester' => '2nd',
			]);
			
			
			$c = AcademicTerm::factory()->create([
				'year_from' => 2023,
				'year_to'   => 2024,
			]);
			AcademicTermSemester::factory()->create([
				'academic_id' => $c->id,
				'semester' => '1st',
			]);
			AcademicTermSemester::factory()->create([
				'academic_id' => $c->id,
				'semester' => '2nd',
			]);
		}
	}
