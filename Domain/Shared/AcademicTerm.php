<?php
	
	namespace Domain\Shared;
	
	class AcademicTerm
	{
		
		protected string $from;
		protected string $to;
		
		
		public function __construct(string $from, string $to)
		{
			$this->from = $from;
			$this->to   = $to;
		}
		
		public function getTerm(): string
		{
			return $this->from . "-" . $this->to;
		}
		
		
	}