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
		Session::put(['role' => 'admin']);
        return redirect('admin/dashboard');
    }
}
