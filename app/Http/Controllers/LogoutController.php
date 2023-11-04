<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\RedirectResponse;
	use Illuminate\Support\Facades\Auth;
	use Illuminate\Support\Facades\Redirect;
	
	class LogoutController extends Controller
	{
		
		public function index(): RedirectResponse
		{
			Auth::logout();
			return Redirect::to('/');
		}
		
	}