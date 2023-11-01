<?php

namespace Database\Factories;

use App\Models\TeachingLoad;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentTaskPerformanceCategory>
 */
class StudentTaskPerformanceCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
	    return [
		    'id'               => uuid(),
		    'date'             => now(),
		    'teaching_load_id' => TeachingLoad::factory(),
		    'points'           => 100,
		    'title'            => $this->faker->title,
		    'created_at'       => now(),
		    'updated_at'       => now(),
	    ];
    }
}
