<?php

	namespace App\Http\Controllers;

	use Illuminate\Http\RedirectResponse;
	use Illuminate\Support\Facades\Auth;
	use Illuminate\Support\Facades\Redirect;
    use Illuminate\Support\Facades\Session;

    class LogoutController extends Controller
	{

		public function index(): RedirectResponse
		{
			Auth::logout();
            Session::flush();
			return Redirect::to('/');
		}

	}
