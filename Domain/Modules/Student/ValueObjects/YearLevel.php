<?php
	
	namespace Domain\Modules\Student\ValueObjects;
	
	class YearLevel
	{
		protected string $year;
		protected string $section;
		
		/**
		 * @param string $year
		 * @param string $section
		 */
		public function __construct(string $year, string $section)
		{
			$this->year    = $year;
			$this->section = $section;
		}
		
		public function getYear(): string
		{
			return $this->year;
		}
		
		public function getSection(): string
		{
			return $this->section;
		}
		
		public function getYearSection(): string
		{
			
			return $this->convertToWord() . " Year - Section " . ucfirst($this->section);
		}
		
		private function convertToWord(): string
		{
			return match ($this->year) {
				'1st' => 'First',
				'2nd' => 'Second',
				'3rd' => 'Third',
				'4rth' => 'Fourth',
				default => 'Not Found',
			};
		}
		
		
	}