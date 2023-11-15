<?php
	
	namespace App\Http\Controllers\Admin;
	
	use App\Http\Controllers\Controller;
	use Domain\Modules\AcademicTerm\Repositories\IAcademicTermRepository;
	use Error;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Validator;
	
	class SetAcademicTermController extends Controller
	{
		
		protected IAcademicTermRepository $academicTermRepository;
		
		public function __construct(IAcademicTermRepository $academicTermRepository)
		{
			$this->academicTermRepository = $academicTermRepository;
		}
		
		
		public function set(Request $req)
		{
			
			
			$val = Validator::make($req->all(), [
				'academic_year' => 'required',
				'semester'      => 'required',
			
			]);
			
			if ($val->fails()) {
				return redirectWithErrors($val);
			}
			
			
			$this->academicTermRepository->removeAllSemesterAsCurrent();
			
			$this->academicTermRepository->setAsCurrentSemester(
				$req->academic_year,
				$req->semester
			);
			
			return redirectWithAlert('/academic-term', [
				'alert-success' => 'Default Academic Term has been set!'
			]);
			
		}
		
		
	}
