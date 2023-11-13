<?php
	
	namespace Database\Factories;
	
	use App\Models\AcademicTerm;
	use App\Models\AcademicTermSemester;
	use App\Models\Course;
	use App\Models\Student;
	use App\Models\Admission;
	use Illuminate\Database\Eloquent\Factories\Factory;
	
	/**
	 * @extends Factory<Admission>
	 */
	class AdmissionFactory extends Factory
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
				'academic_term_semester_id' => AcademicTermSemester::inRandomOrder()->first(),
				'student_id'                => Student::inRandomOrder()->first(),
				'course_id'                 => Course::inRandomOrder()->first(),
				'year_level'                => '1st',
				'section'                   => 'a',
				'created_at'                => now(),
				'updated_at'                => now(),
			];
		}
	}
