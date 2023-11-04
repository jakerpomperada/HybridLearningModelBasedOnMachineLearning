<?php
	
	namespace App\Http\Controllers\Teacher;
	
	use App\Models\Teacher;
	use Illuminate\Support\Facades\Auth;
	use Illuminate\Support\Facades\DB;
	
	trait TeacherControllerTrait
	{
		public function getTeacherId(): string {
			$id = Auth::id();
			$teacher = DB::table('teachers')->where([
				'user_id' => $id
			])->first();
			return $teacher->id;
		}
	}