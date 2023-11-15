<?php
	
	namespace Database\Factories;
	
	use App\Models\AcademicTermSemester;
	use App\Models\Course;
	use App\Models\Subject;
	use App\Models\Teacher;
	use App\Models\TeachingLoad;
	use Illuminate\Database\Eloquent\Factories\Factory;
	
	/**
	 * @extends Factory<TeachingLoad>
	 */
	class TeachingLoadFactory extends Factory
	{
		/**
		 * Define the model's default state.
		 *
		 * @return array<string, mixed>
		 */
		public function definition(): array
		{
			return [
				'id'                        => uuid(),
				'teacher_id'                => Teacher::inRandomOrder()->first(),
				'subject_id'                => Subject::inRandomOrder()->first(),
				'academic_term_semester_id' => AcademicTermSemester::inRandomOrder()->first(),
				'year_level'                => '1st',
				'section'                   => 'a',
				'semester'                  => '1st',
				'course_id'                 => Course::inRandomOrder()->first(),
				'created_at'                => now(),
				'updated_at'                => now(),
			];
		}
	}
