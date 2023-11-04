<?php
	
	namespace Database\Factories;
	
	use App\Models\AcademicTerm;
	use App\Models\AcademicTermSemester;
	use Illuminate\Database\Eloquent\Factories\Factory;
	
	/**
	 * @extends Factory<AcademicTermSemester>
	 */
	class AcademicTermSemesterFactory extends Factory
	{
		/**
		 * Define the model's default state.
		 *
		 * @return array<string, mixed>
		 */
		public function definition(): array
		{
			return [
				'id'          => uuid(),
				'academic_id' => AcademicTerm::inRandomOrder()->first(),
				'semester'    => '1st',
				'created_at'  => now(),
				'updated_at'  => now(),
			];
		}
	}
