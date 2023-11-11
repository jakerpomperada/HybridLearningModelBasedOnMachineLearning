<?php
	
	namespace Domain\Modules\Teacher\Entities;
	
	class ExamAssessmentChoice
	{
		
		protected int $order;
		protected string $choice;
		protected bool $is_correct;
		
		public function __construct(int $order, string $choice, bool $is_correct)
		{
			$this->order      = $order;
			$this->choice     = $choice;
			$this->is_correct = $is_correct;
		}
		
		public function getOrder(): int
		{
			return $this->order;
		}
		
		public function getChoice(): string
		{
			return $this->choice;
		}
		
		public function isCorrect(): bool
		{
			return $this->is_correct;
		}
		
		
		
		
		public static function choices(): array
		{
			return [
				1 => 'A',
				2 => 'B',
				3 => 'C',
				4 => 'D',
			];
		}
	}