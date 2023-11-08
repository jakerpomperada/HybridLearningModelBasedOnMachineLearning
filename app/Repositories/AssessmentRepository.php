<?php
	
	namespace App\Repositories;
	
	use App\Models\StudentQuizAssessmentQuestion;
	use Domain\Modules\Assessment\Repositories\IAssessmentRepository;
	use Illuminate\Contracts\Pagination\Paginator;
	
	class AssessmentRepository implements IAssessmentRepository
	{
		
		
		public function GetAllQuizByCategoryPaginate(string $cat_id, int $page): Paginator
		{
			return StudentQuizAssessmentQuestion::where([
				'qacategory_id' => $cat_id,
			])->paginate($page);
		}
		
		
	}