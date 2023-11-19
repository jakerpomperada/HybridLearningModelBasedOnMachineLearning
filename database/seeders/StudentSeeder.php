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
			
			
			foreach (User::where(['type' => 'student'])->get() as $user) {
				Student::factory()->create([
					'user_id' => $user->id
				]);
			}
			
			
		}
	}
