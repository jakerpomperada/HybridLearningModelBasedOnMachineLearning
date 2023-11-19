<?php
	
	namespace Database\Seeders;
	
	use App\Models\AcademicTermSemester;
	use App\Models\Course;
	use App\Models\Student;
	use App\Models\Admission;
	use Illuminate\Database\Console\Seeds\WithoutModelEvents;
	use Illuminate\Database\Seeder;
	
	class StudentAdmissionSeeder extends Seeder
	{
		/**
		 * Run the database seeds.
		 */
		public function run(): void
		{
			Admission::query()->delete();
			$course = Course::first();
			$term_semester = AcademicTermSemester::first();
			
			foreach (Student::all() as $student) {
				Admission::factory()->create([
					'academic_term_semester_id' => $term_semester->id,
					'student_id'                => $student->id,
					'course_id'                 => $course->id,
					'year_level'                => '1st',
					'section'                   => 'a'
				]);
			}
			
		}
	}
