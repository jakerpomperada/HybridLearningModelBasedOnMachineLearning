<?php
	
	namespace Database\Seeders;
	
	use App\Models\AcademicTermSemester;
	use App\Models\Course;
	use App\Models\Subject;
	use App\Models\Teacher;
	use App\Models\TeachingLoad;
	use Illuminate\Database\Seeder;
	
	class TeachingLoadSeeder extends Seeder
	{
		/**
		 * Run the database seeds.
		 */
		public function run(): void
		{
			TeachingLoad::query()->delete();
			
			$subject = Subject::first();
			$term_semester = AcademicTermSemester::first();
			$course = Course::first();
			
			foreach (Teacher::all() as $teacher) {
				TeachingLoad::factory()->create([
					'teacher_id'                => $teacher->id,
					'subject_id'                => $subject->id,
					'academic_term_semester_id' => $term_semester->id,
					'year_level'                => '1st',
					'section'                   => 'a',
					'semester'                  => '1st',
					'course_id'                 => $course->id,
				]);
			}
		
		}
	}
