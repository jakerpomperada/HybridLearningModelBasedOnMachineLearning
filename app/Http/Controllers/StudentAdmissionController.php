<?php
	
	namespace App\Http\Controllers;
	
	use App\Services\BaseDataDropDownService;
	use Illuminate\Http\Request;
	use Illuminate\View\View;
	
	class StudentAdmissionController extends Controller
	{
		protected BaseDataDropDownService $baseDataDropDownService;
		
		
		public function __construct(BaseDataDropDownService $baseDataDropDownService)
		{
			$this->baseDataDropDownService = $baseDataDropDownService;
		}
		
		
		public function index(): View
		{
			return view('student-admission.index')->with([
				'admissions' => [],
				'paginate'   => ''
			]);
		}
		
		public function create()
		{
			$data = $this->baseDataDropDownService->getBaseData();
			
			$students = $this->baseDataDropDownService->students();
			
			
			return view('student-admission.create')->with([
				'students'   => $students,
				'subjects'   => $data->subjects,
				'terms'      => $data->terms,
				'semesters'  => $data->semesters,
				'courses'    => $data->courses,
				'year_level' => $data->year_level,
				'sections'   => $data->sections
			]);
		}
		
		
	}
