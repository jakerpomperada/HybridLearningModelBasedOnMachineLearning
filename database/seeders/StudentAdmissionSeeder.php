<?php
	
	namespace Database\Seeders;
	
	use App\Models\Student;
	use App\Models\Admission;
	use Illuminate\Database\Console\Seeds\WithoutModelEvents;
	use Illuminate\Database\Seeder;
	
	class StudentAdmissionSeeder extends Seeder
	{
		/**
		 * Run the database seeds.
		 */
		public function run(): void
		{
			Admission::query()->delete();
			
			foreach (Student::all() as $student) {
				Admission::factory()->create([
					'student_id' => $student->id
				]);
			}
			
		}
	}
