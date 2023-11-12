<?php
	
	namespace Domain\Modules\Assessment\Entities;
	
	use Domain\Shared\Entity;
	
	class ExamAssessmentCategory extends Entity
	{
	
		protected string $date_start;
		protected string $date_end;
		protected string $term;
		protected string $status;
		
		public function __construct(string $date_start, string $date_end, string $term, string $status, ?string $id = null)
		{
			parent::__construct($id);
			$this->date_start = $date_start;
			$this->date_end   = $date_end;
			$this->term       = $term;
			$this->status = $status;
		}
		
		public function getStatus() : string {
			return $this->status;
		}
		
		
		
		public function getDateStart(): string
		{
			return $this->date_start;
		}
		
		public function getDateEnd(): string
		{
			return $this->date_end;
		}
		
		public function getTerm(): string
		{
			return $this->term;
		}
		
		
		
		
	}