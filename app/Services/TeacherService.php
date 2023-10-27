<?php
	
	namespace App\Services;
	
	use Domain\Modules\Teacher\Repositories\ITeacherRepository;
	
	class TeacherService
	{
		
		protected ITeacherRepository $teacherRepository;
		
	
		public function __construct(ITeacherRepository $teacherRepository)
		{
			$this->teacherRepository = $teacherRepository;
		}
		
		
		public function getSubjectLoads(string $teacher_id) {
			$loading       = $this->teacherRepository->GetAllTeachingLoads($teacher_id);
			
			return $loading->mapWithKeys(function ($item, $i) {
				return [
					$item->id => '' . $item->getSubjectCode() . ' [' . $item->getYearLevel() . '-' . $item->getSection() . ']'
				];
			});
			
		}
	}