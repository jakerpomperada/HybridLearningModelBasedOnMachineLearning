<?php
	
	namespace App\Http\Controllers\Student;
	
	use Illuminate\View\View;
	
	class DashboardController
	{
		public function index(): View
		{
			return view('student.dashboard.index');
			
		}
	}