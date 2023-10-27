<?php
	
	namespace Database\Factories;
	
	use App\Models\AcademicTerm;
	use App\Models\AcademicTermSemester;
	use App\Models\Course;
	use App\Models\Student;
	use App\Models\StudentAdmission;
	use Illuminate\Database\Eloquent\Factories\Factory;
	
	/**
	 * @extends Factory<StudentAdmission>
	 */
	class StudentAdmissionFactory extends Factory
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
				'academic_term_semester_id' => AcademicTermSemester::factory(),
				'student_id'                => Student::factory(),
				'course_id'                 => Course::factory(),
				'year_level'                => '1st',
				'section'                   => 'a',
				'created_at'                => now(),
				'updated_at'                => now(),
			];
		}
	}
