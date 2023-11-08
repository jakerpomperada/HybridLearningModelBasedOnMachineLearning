<?php
	
	namespace Domain\Modules\Assessment\Repositories;
	
	use Illuminate\Contracts\Pagination\Paginator;
	
	interface IAssessmentRepository
	{
	
		public function GetAllQuizByCategoryPaginate(string $cat_id, int $page) : Paginator;
		
		
	}