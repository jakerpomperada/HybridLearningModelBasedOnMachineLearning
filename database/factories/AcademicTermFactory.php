<?php
	
	namespace Database\Factories;
	
	use App\Models\AcademicTerm;
	use Illuminate\Database\Eloquent\Factories\Factory;
	
	/**
	 * @extends Factory<AcademicTerm>
	 */
	class AcademicTermFactory extends Factory
	{
		/**
		 * Define the model's default state.
		 *
		 * @return array<string, mixed>
		 */
		public function definition(): array
		{
			return [
				'id'         => uuid(),
				'year_from'  => 2021,
				'year_to'    => 2022,
				'created_at' => now(),
				'updated_at' => now(),
			];
		}
	}
