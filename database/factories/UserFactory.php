<?php

    namespace Database\Factories;

    use App\Models\User;
    use Illuminate\Database\Eloquent\Factories\Factory;
    use Illuminate\Support\Str;

    /**
     * @extends Factory<User>
     */
    class UserFactory extends Factory
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
                'username'   => $this->faker->userName,
                'password'   => $this->faker->password,
                'type'       => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        /**
         * Indicate that the model's email address should be unverified.
         */
        public function unverified(): static
        {
            return $this->state(fn(array $attributes) => [
                'email_verified_at' => null,
            ]);
        }
    }
