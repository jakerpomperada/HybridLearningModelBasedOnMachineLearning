<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class DashboardAdminController extends Controller
{
    public function index() {
		
        return view('admin.dashboard.index')->with([
			'role' => Session::get('role')
        ]);
    }
}
