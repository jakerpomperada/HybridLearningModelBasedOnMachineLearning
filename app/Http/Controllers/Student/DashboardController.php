<?php
	
	namespace App\Http\Controllers\Student;
	
	use App\Models\Student;
	use Illuminate\Support\Facades\Auth;
	use Illuminate\View\View;
	
	class DashboardController
	{
		public function index(): View
		{
			$student = Student::where('user_id', Auth::id())->first();
			
			return view('student.dashboard.index')->with([
				'student' => (object) [
					'complete_name' => $student->completeName()
				]
			]);
			
		}
	}