<?php
	
	namespace Database\Seeders;
	
	use App\Models\Subject;
	use Illuminate\Database\Seeder;
	
	class SubjectSeeder extends Seeder
	{
		/**
		 * Run the database seeds.
		 */
		public function run(): void
		{
			Subject::query()->delete();
			Subject::factory()->create([
				'code'        => 'CCP 1101',
				'description' => 'Computer Programming 1',
			]);
			
			Subject::factory()->create([
				'code'        => 'CFD 1101',
				'description' => 'Fundamentals of Database Systems',
			]);
			
			Subject::factory()->create([
				'code'        => 'CBM 1101',
				'description' => 'Business Process Management',
			]);
			
			Subject::factory()->create([
				'code'        => 'CHC 1101',
				'description' => 'Human Computer Interaction',
			]);
		}
	}
