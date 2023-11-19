<?php
	
	namespace Database\Seeders;
	
	use App\Models\Course;
	use Illuminate\Database\Seeder;
	
	class CourseSeeder extends Seeder
	{
		/**
		 * Run the database seeds.
		 */
		public function run(): void
		{
			Course::query()->delete();
			Course::factory()->create([
				'code'        => 'BSIT',
				'description' => 'Bachelor of Science in Information Technology'
			]);
		
		}
	}
