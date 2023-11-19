<?php
	
	namespace Database\Seeders;
	
	use App\Models\Admission;
	use App\Models\StudentTaskPerformanceCategory;
	use App\Models\StudentTaskPerformances;
	use App\Models\TeachingLoad;
	use Illuminate\Database\Console\Seeds\WithoutModelEvents;
	use Illuminate\Database\Seeder;
	
	class StudentTaskPerformanceSeeder extends Seeder
	{
		/**
		 * Run the database seeds.
		 */
		public function run(): void
		{
			StudentTaskPerformanceCategory::query()->delete();
			
			$teaching_load = TeachingLoad::first();
			
			
			$stpc = StudentTaskPerformanceCategory::factory()->create([
				'teaching_load_id' => $teaching_load->id,
				'points'           => 100,
				'title'            => "First Task Performance",
			]);
			
			foreach (Admission::all() as $admission) {
				StudentTaskPerformances::factory()->create([
					'stpc_id'              => $stpc->id,
					'student_admission_id' => $admission->id,
					'score'                => 60,
				]);
			}
			
			
		
			
			
			
		}
	}
