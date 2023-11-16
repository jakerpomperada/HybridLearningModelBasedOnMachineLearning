<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Domain\Modules\AcademicTerm\Repositories\IAcademicTermRepository;
use Domain\Shared\AcademicTerm;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardAdminController extends Controller
{
	
	protected IAcademicTermRepository $academicTermRepository;
	
	/**
	 * @param IAcademicTermRepository $academicTermRepository
	 */
	public function __construct(IAcademicTermRepository $academicTermRepository)
	{
		$this->academicTermRepository = $academicTermRepository;
	}
	
	
	public function index() {

		
		$term = $this->academicTermRepository->GetCurrentAcademicTerm();
		
		$term = new AcademicTerm($term->year_from, $term->year_to,$term->semester);
		
		
        return view('admin.dashboard.index')->with([
			'role' => Session::get('role'),
	        'term' => $term->getTerm() . " (".$term->displaySemester().")"
        ]);
    }
}
