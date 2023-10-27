<?php
	
	namespace Database\Seeders;
	
	use App\Models\Student;
	use App\Models\StudentAdmission;
	use Illuminate\Database\Console\Seeds\WithoutModelEvents;
	use Illuminate\Database\Seeder;
	
	class StudentAdmissionSeeder extends Seeder
	{
		/**
		 * Run the database seeds.
		 */
		public function run(): void
		{
			StudentAdmission::query()->delete();
			
			foreach (Student::all() as $student) {
				StudentAdmission::factory()->create([
					'student_id' => $student->id
				]);
			}
			
		}
	}
