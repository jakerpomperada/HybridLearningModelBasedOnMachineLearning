<?php
	
	namespace Database\Seeders;
	
	use App\Models\User;
	use Illuminate\Database\Console\Seeds\WithoutModelEvents;
	use Illuminate\Database\Seeder;
	
	class UserSeeder extends Seeder
	{
		/**
		 * Run the database seeds.
		 */
		public function run(): void
		{
			User::factory()->create([
				'username' => 'admin',
				'type'     => 'admin'
			]);
			
			User::factory()->create([
				'username' => 'teacher',
				'type'     => 'teacher'
			]);
			
			User::factory()->create([
				'username' => 'student',
				'type'     => 'student'
			]);
		}
	}
