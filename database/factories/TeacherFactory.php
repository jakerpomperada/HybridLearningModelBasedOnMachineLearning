<?php
	
	namespace Database\Factories;
	
	use App\Models\Teacher;
	use App\Models\User;
	use Illuminate\Database\Eloquent\Factories\Factory;
	
	/**
	 * @extends Factory<Teacher>
	 */
	class TeacherFactory extends Factory
	{
		/**
		 * Define the model's default state.
		 *
		 * @return array<string, mixed>
		 */
		public function definition(): array
		{
			return [
				'id'             => uuid(),
				'user_id'        => User::inRandomOrder()->where(['type' => 'teacher'])->first(),
				'image'          => 'temp.jpg',
				'id_number'      => $this->faker->numberBetween(111111111, 999999999),
				'firstname'      => $this->faker->firstName,
				'lastname'       => $this->faker->lastName,
				'middlename'     => $this->faker->lastName,
				'birthdate'      => $this->faker->date,
				'contact_number' => $this->faker->numberBetween(111111111, 999999999),
				'address'        => $this->faker->paragraph,
				'created_at'     => now(),
				'updated_at'     => now()
			];
		}
	}
