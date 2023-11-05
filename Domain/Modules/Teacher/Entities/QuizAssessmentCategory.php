<?php
	
	namespace Domain\Modules\Teacher\Entities;
	
	use Domain\Shared\Entity;
	
	class QuizAssessmentCategory extends Entity
	{
		protected string $date_start;
		protected string $status;
		protected string $date_end;
		protected string $title;
		protected array $questions;
		
		
		public function __construct(string $date_start, string $date_end, string $title, string $status, ?string $id = null)
		{
			parent::__construct($id);
			$this->date_start = $date_start;
			$this->date_end   = $date_end;
			$this->title      = $title;
			$this->status     = $status;
		}
		
		public function getStatus(): string
		{
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
		
		public function getTitle(): string
		{
			return $this->title;
		}
		
		public function getQuestions(): array
		{
			return $this->questions;
		}
		
		public function setQuestions(QuizAssessmentQuestion $questions): void
		{
			$this->questions[] = $questions;
		}
		
		
	}