<?php
	
	namespace Domain\Modules\Teacher\Entities;
	
	class QuizScore
	{
		protected float $score;
		
		
		public function __construct(string | float $score)
		{
			$this->score = (float) $score;
		}
		
		public function getScore(): float
		{
			return $this->score;
		}
		
	}