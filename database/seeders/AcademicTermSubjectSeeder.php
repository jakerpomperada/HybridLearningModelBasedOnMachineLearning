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
			AcademicTermSubject::factory()->count(1)->create([
				'id'                        => uuid(),
				'academic_term_semester_id' => AcademicTermSemester::factory(),
				'course_id'                 => Course::factory(),
				'subject_id'                => Subject::factory(),
				'year_level'                => '1st',
				'created_at'                => now(),
				'updated_at'                => now(),
			]);
		}
	}
