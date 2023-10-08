<?php
	
	namespace Database\Seeders;
	
	// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
	use App\Models\AcademicTerm;
	use App\Models\Subject;
	use App\Models\User;
	use Database\Factories\StudentFactory;
	use Illuminate\Database\Seeder;
	use Illuminate\Support\Facades\Artisan;
	
	class DatabaseSeeder extends Seeder
	{
		/**
		 * Seed the application's database.
		 */
		public function run(): void
		{
			User::query()->delete();
			
			$this->call([
				StudentSeeder::class,
				TeacherSeeder::class,
				CourseSeeder::class,
				SubjectSeeder::class,
				AcademicTermSeeder::class
			]);
		}
	}
