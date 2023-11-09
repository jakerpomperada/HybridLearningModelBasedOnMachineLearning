<?php
	
	namespace Domain\Modules\Teacher\Entities;
	
	use Domain\Shared\Entity;
	
	class QuizAssessmentQuestion extends Entity
	{
		protected string $question;
		protected array $choices;
		
		public function __construct(string $question , ?string $id = null )
		{
			parent::__construct($id);
			$this->question = $question;
		}
		
		public function getQuestion(): string
		{
			return $this->question;
		}
		
		
		public function getChoices(): array
		{
			return $this->choices;
		}
		
		public function setChoices(QuizAssessmentChoice $choice): void
		{
			$this->choices[] = $choice;
		}
		
		
		
		
		
		
		
		
		
		
	}