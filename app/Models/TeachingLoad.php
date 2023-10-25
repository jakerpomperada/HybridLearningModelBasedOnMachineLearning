<?php
	
	namespace App\Models;
	
	use Illuminate\Database\Eloquent\Factories\HasFactory;
	use Illuminate\Database\Eloquent\Model;
	use Illuminate\Database\Eloquent\Relations\BelongsTo;
	
	class TeachingLoad extends Model
	{
		use HasFactory;
		use Uuid;
		
		public $incrementing = false;
		protected $table = 'teaching_loads';
		protected $keyType = 'string';
		protected $guarded = [];
		
		public function Teacher(): BelongsTo
		{
			return $this->belongsTo(Teacher::class);
		}
		
		public function Subject(): BelongsTo
		{
			return $this->belongsTo(Subject::class);
		}
		
		public function Course(): BelongsTo
		{
			return $this->belongsTo(Course::class);
		}
		
		
		public function getTeacherCompleteName(): string
		{
			return $this->Teacher->completeName();
		}
		
		
		public function getSubjectCode(): string
		{
			return $this->Subject->getCode();
		}
		
		public function getSubjectDescription(): string
		{
			return $this->Subject->getDescription();
		}
		
		public function getSemester(): string
		{
			return semester($this->semester);
		}
		
		public function getSection() : string {
			return strtoupper($this->section);
		}
		
		public function getCourse(): string
		{
			return $this->Course->getCode();
		}
		
		public function getYearLevel(): string
		{
			return  yearLevel($this->year_level);
		}
		
		
		
		
	}
