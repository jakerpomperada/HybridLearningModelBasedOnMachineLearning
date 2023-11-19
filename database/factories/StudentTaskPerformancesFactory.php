<?php
	
	namespace Database\Factories;
	
	use App\Models\Admission;
	use App\Models\StudentTaskPerformanceCategory;
	use App\Models\StudentTaskPerformances;
	use App\Models\TeachingLoad;
	use Illuminate\Database\Eloquent\Factories\Factory;
	
	/**
	 * @extends Factory<StudentTaskPerformances>
	 */
	class StudentTaskPerformancesFactory extends Factory
	{
		/**
		 * Define the model's default state.
		 *
		 * @return array<string, mixed>
		 */
		public function definition(): array
		{
			return [
				'id'                   => uuid(),
				'stpc_id'              => StudentTaskPerformanceCategory::factory(),
				'student_admission_id' => Admission::factory(),
				'score'                => 30,
				'created_at'           => now(),
				'updated_at'           => now(),
			];
		}
	}
