<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class DashboardAdminController extends Controller
{
    public function index() {
		
        return view('admin.dashboard.index')->with([
			'role' => Session::get('role')
        ]);
    }
}
