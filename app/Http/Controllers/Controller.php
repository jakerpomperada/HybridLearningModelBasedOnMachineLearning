<?php

	namespace App\Http\Controllers;

	use App\Models\AcademicTermSemester;
    use Domain\Shared\AcademicTerm;
	use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
	use Illuminate\Foundation\Validation\ValidatesRequests;
	use Illuminate\Routing\Controller as BaseController;
	use Illuminate\Support\Facades\Session;

	class Controller extends BaseController
	{
		use AuthorizesRequests, ValidatesRequests;



		public function getCurrentTerm() : AcademicTerm {
            $sem_term = AcademicTermSemester::with(['AcademicTerm'])->where([
                'is_current' => 1
            ])->first();

            $term = $sem_term->AcademicTerm;

            return new AcademicTerm($term->year_from,$term->year_to, $sem_term->semester);
		}

        public function getAcademicSemesterTerm() {
           return AcademicTermSemester::with(['AcademicTerm'])->where([
                'is_current' => 1
            ])->first();
        }


	}
