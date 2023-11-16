<?php
	
	namespace Database\Seeders;
	
	use App\Models\Student;
	use App\Models\User;
	use Illuminate\Database\Seeder;
	
	class StudentSeeder extends Seeder
	{
		/**
		 * Run the database seeds.
		 */
		public function run(): void
		{
			Student::query()->delete();
			
			$user = User::where([
				'type' => 'student'
			])->first();
			
			Student::factory()->create([
				'user_id' => $user->id
			]);
		}
	}
