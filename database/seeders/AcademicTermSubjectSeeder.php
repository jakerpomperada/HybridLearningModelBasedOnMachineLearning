<?php
	
	namespace Database\Seeders;
	
	use App\Models\AcademicTermSemester;
	use App\Models\AcademicTermSubject;
	use App\Models\Course;
	use App\Models\Subject;
	use Illuminate\Database\Seeder;
	
	class AcademicTermSubjectSeeder extends Seeder
	{
		/**
		 * Run the database seeds.
		 */
		public function run(): void
		{
			AcademicTermSubject::query()->delete();
			
			
			$term_semester = AcademicTermSemester::first();
			$course = Course::first();
			
			
			foreach (Subject::all() as $subject) {
				AcademicTermSubject::factory()->create([
					'id'                        => uuid(),
					'academic_term_semester_id' => $term_semester->id,
					'course_id'                 => $course->id,
					'subject_id'                => $subject->id,
					'year_level'                => '1st',
					'created_at'                => now(),
					'updated_at'                => now(),
				]);
			}
			
		}
	}
