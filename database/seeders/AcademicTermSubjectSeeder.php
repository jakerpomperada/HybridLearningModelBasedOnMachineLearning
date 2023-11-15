<?php
	
	namespace Database\Seeders;
	
	use App\Models\AcademicTerm;
	use App\Models\AcademicTermSemester;
	use App\Models\AcademicTermSubject;
	use App\Models\Course;
	use App\Models\Subject;
	use Database\Factories\AcademicTermFactory;
	use Illuminate\Database\Console\Seeds\WithoutModelEvents;
	use Illuminate\Database\Seeder;
	
	class AcademicTermSubjectSeeder extends Seeder
	{
		/**
		 * Run the database seeds.
		 */
		public function run(): void
		{
			AcademicTermSubject::factory()->count(5)->create([
				'id'                        => uuid(),
				'academic_term_semester_id' => AcademicTermSemester::inRandomOrder()->first(),
				'course_id'                 => Course::inRandomOrder()->first(),
				'subject_id'                => Subject::inRandomOrder()->first(),
				'year_level'                => '1st',
				'created_at'                => now(),
				'updated_at'                => now(),
			]);
		}
	}
