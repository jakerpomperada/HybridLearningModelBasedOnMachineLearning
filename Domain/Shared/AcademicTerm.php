<?php

	namespace Domain\Shared;

	class AcademicTerm
	{

		public string $from;
		public string $to;
		public string $semester;


		public function __construct(string $from, string $to, string $semester)
		{
			$this->from = $from;
			$this->to   = $to;
			$this->semester = $semester;
		}

		public function getTerm(): string
		{
			return $this->from . "-" . $this->to;
		}

		public function displaySemester() : string {
			return match ($this->semester) {
				'1st' => 'First Semester',
				default => 'Second Semester',
			};
		}


	}
