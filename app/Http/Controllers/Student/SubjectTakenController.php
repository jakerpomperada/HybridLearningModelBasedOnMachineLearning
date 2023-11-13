<?php
	
	namespace App\Http\Controllers\Student;
	
	use App\Http\Controllers\Controller;
	
	class SubjectTakenController extends Controller
	{
		public function index()
		{
			return view('student.subject-taken.index');
		}
	}
