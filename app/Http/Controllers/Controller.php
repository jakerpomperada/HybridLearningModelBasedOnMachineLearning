<?php
	
	namespace App\Http\Controllers;
	
	use Domain\Shared\AcademicTerm;
	use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
	use Illuminate\Foundation\Validation\ValidatesRequests;
	use Illuminate\Routing\Controller as BaseController;
	use Illuminate\Support\Facades\Session;
	
	class Controller extends BaseController
	{
		use AuthorizesRequests, ValidatesRequests;
		
		
		
		public function getCurrentTerm() : AcademicTerm {
			return new AcademicTerm(2022,2023, '1st');
		}
		
		
	}
