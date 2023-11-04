<?php
	
	namespace App\Http\Controllers\Teacher;
	
	use Illuminate\Support\Facades\Session;
	
	class DashboardController
	{
		public function index () {
			return view('teacher/dashboard.index')->with([
				'role' => Session::get('role')
			]);
		}
	}