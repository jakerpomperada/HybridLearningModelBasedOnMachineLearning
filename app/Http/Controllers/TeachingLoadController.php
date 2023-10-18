<?php
	
	namespace App\Http\Controllers;
	
	use App\Services\BaseDataDropDownService;
	use Domain\Modules\Course\Repositories\ICourseRepository;
	use Domain\Modules\Subject\Repositories\ISubjectRepository;
	use Domain\Modules\Teacher\Repositories\ITeacherRepository;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Validator;
	use Illuminate\View\View;
	use Error;
	
	class TeachingLoadController extends Controller
	{
		protected BaseDataDropDownService $baseDataDropDownService;
		protected ITeacherRepository $teacherRepository;
		
		
		public function __construct(BaseDataDropDownService $baseDataDropDownService, ITeacherRepository $teacherRepository)
		{
			$this->baseDataDropDownService = $baseDataDropDownService;
			$this->teacherRepository       = $teacherRepository;
		}
		
		
		public function index()
		{
			return view('teaching-load.index')->with([
				'subjects' => [],
				'paginate' => ""
			]);
			
		}
		
		public function create(): View
		{
			$data = $this->baseDataDropDownService->getBaseData();
			
			
			$teachers = $this->teacherRepository->GetAll();
			
			$teachers = $teachers->mapWithKeys(function ($item, $key) {
				return [$item->id => $item->completeName()];
			});
			
			return view('teaching-load.create')->with([
				'teachers'   => $teachers,
				'subjects'   => $data->subjects,
				'terms'      => $data->terms,
				'semesters'  => $data->semesters,
				'courses'    => $data->courses,
				'year_level' => $data->year_level,
				'sections'   => $data->sections
			]);
		}
		
		public function store(Request $req)
		{
			
			
			try {
				
				$val = Validator::make($req->all(), [
					'teacher'    => 'required',
					'subject'    => 'required',
					'year_level' => 'required',
					'section'    => 'required',
					'semester'   => 'required',
					'course'     => 'required',
				]);
				
				if ($val->fails()) {
					throw new Error($val->getMessageBag()->all()[0]);
				}
			
				$this->teacherRepository->SaveTeachingLoad(
					$req->teacher,
					$req->subject,
					$req->year_level,
					$req->section,
					$req->semester,
					$req->course,
				);
				
				return redirectWithAlert('/teaching-load', [
					'alert-success' => 'New teaching load has been added!'
				]);
				
				
				
				
			} catch (Error $error) {
				return redirectExceptionWithInput($error);
			}
			
			
		}
		
		
	}
