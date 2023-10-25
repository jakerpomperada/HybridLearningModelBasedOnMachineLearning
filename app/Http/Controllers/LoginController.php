<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index() {
        return view('login.index');
    }

    public function login(Request $request) {
		$role = $request->input('username');
	
		Session::put(['role' => $role]);
		if ($role == 'admin') {
			return redirect('admin/dashboard');
		}elseif ($role == 'student') {
			return redirect('student/dashboard');
		} else {
			return redirect('teacher/dashboard');
		}
    
    }
}
