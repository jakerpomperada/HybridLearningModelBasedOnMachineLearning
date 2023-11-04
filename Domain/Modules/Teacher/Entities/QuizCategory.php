<?php
	
	namespace Domain\Modules\Teacher\Entities;
	
	use Domain\Shared\Entity;
	
	class QuizCategory extends Entity
	{
		protected string $date;
		protected float $points;
		protected string $title;
		
		
		public function __construct(string $date, float $points, string $title, ?string $id = null)
		{
			parent::__construct($id);
			$this->date   = $date;
			$this->points = $points;
			$this->title  = $title;
		}
		
		public function getDate(): string
		{
			return $this->date;
		}
		
		public function getPoints(): float
		{
			return $this->points;
		}
		
		public function getTitle(): string
		{
			return $this->title;
		}
		
		
		
		
	}