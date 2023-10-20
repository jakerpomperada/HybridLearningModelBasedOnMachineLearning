<?php
	
	namespace App\Repositories;
	
	use App\Models\TeachingLoad;
	use Domain\Modules\Teacher\Entities\Teacher;
	use Domain\Modules\Teacher\Repositories\ITeacherRepository;
	use Illuminate\Contracts\Pagination\Paginator;
	use Illuminate\Database\Eloquent\Collection;
	use Illuminate\Support\Facades\DB;
	use App\Models\Teacher as TeacherDB;
	
	class TeacherRepository implements ITeacherRepository
	{
		
		public function Save(Teacher $teacher): void
		{
			DB::table('teachers')->insert([
				'id'             => $teacher->getId(),
				'image'          => $teacher->getImage()->getImageName(),
				'id_number'      => $teacher->getIdNumber(),
				'firstname'      => $teacher->getFirstname(),
				'lastname'       => $teacher->getLastname(),
				'middlename'     => $teacher->getMiddlename(),
				'birthdate'      => $teacher->getBirthdate(),
				'contact_number' => $teacher->getContactNumber(),
				'address'        => $teacher->getAddress(),
				'created_at'     => now(),
				'updated_at'     => now(),
			]);
		}
		
		public function Update(Teacher $teacher): void
		{
			TeacherDB::where(['id' => $teacher->getId()])->update([
				'image'          => $teacher->getImage()->getImageName(),
				'id_number'      => $teacher->getIdNumber(),
				'firstname'      => $teacher->getFirstname(),
				'lastname'       => $teacher->getLastname(),
				'middlename'     => $teacher->getMiddlename(),
				'birthdate'      => $teacher->getBirthdate(),
				'contact_number' => $teacher->getContactNumber(),
				'address'        => $teacher->getAddress()
			]);
		}
		
		public function Delete(string $id): void
		{
			DB::table('teachers')->delete($id);
		}
		
		public function GetAllPaginate(int $page, int $limit): Paginator
		{
			return TeacherDB::paginate($limit);
		}
		
		public function GetAll(): Collection
		{
			return TeacherDB::all();
		}
		
		public function Find(string $id): object|null
		{
			return DB::table('teachers')->where(['id' => $id])->first();
		}
		
		public function SaveTeachingLoad(string $teacher_id, string $subject_id, string $year_level, string $section, string $semester, string $course_id): void
		{
			DB::table('teaching_loads')->insert([
				'id'         => uuid(),
				'teacher_id' => $teacher_id,
				'subject_id' => $subject_id,
				'year_level' => $year_level,
				'section'    => $section,
				'semester'   => $semester,
				'course_id'  => $course_id,
				'created_at' => now(),
				'updated_at' => now(),
			]);
		}
		
		public function GetAllTeachingLoadPaginate(int $page, int $limit): Paginator
		{
			return TeachingLoad::with(['Teacher', 'Subject', 'Course'])->paginate($limit);
		}
		
		public function UpdateTeachingLoad(string $teacher_id, string $subject_id, string $year_level, string $section, string $semester, string $course_id, string $id): void
		{
			TeachingLoad::find($id)->update([
				'teacher_id' => $teacher_id,
				'subject_id' => $subject_id,
				'year_level' => $year_level,
				'section'    => $section,
				'semester'   => $semester,
				'course_id'  => $course_id,
				'updated_at' => now(),
			]);
		}
		
		public function FindTeachingLoad(string $id): object | null
		{
			return DB::table('teaching_loads')->where(['id' => $id])->first();
		}
	}
