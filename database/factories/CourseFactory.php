<?php
	
	namespace Database\Factories;
	
	use App\Models\Course;
	use Illuminate\Database\Eloquent\Factories\Factory;
	
	/**
	 * @extends Factory<Course>
	 */
	class CourseFactory extends Factory
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
				'code'        => $this->faker->countryCode,
				'description' => $this->faker->country,
				'created_at'  => now(),
				'updated_at'  => now(),
			];
		}
	}
