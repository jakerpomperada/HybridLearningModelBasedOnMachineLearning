<?php
	
	namespace Domain\Modules\Student\ValueObjects;
	
	class Course
	{
		protected string $code;
		protected string $description;
		
		/**
		 * @param string $code
		 * @param string $description
		 */
		public function __construct(string $code, string $description)
		{
			$this->code        = $code;
			$this->description = $description;
		}
		
		public function getCode(): string
		{
			return $this->code;
		}
		
		public function getCourse() : string {
			return $this->code ."-". $this->description;
		}
		
		public function setCode(string $code): void
		{
			$this->code = $code;
		}
		
		public function getDescription(): string
		{
			return $this->description;
		}
		
		public function setDescription(string $description): void
		{
			$this->description = $description;
		}
		
		
		
		
		
	}