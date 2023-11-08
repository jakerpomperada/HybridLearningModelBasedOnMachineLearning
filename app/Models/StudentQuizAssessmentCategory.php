<?php
	
	namespace App\Models;
	
	use Illuminate\Database\Eloquent\Factories\HasFactory;
	use Illuminate\Database\Eloquent\Model;
	use Illuminate\Support\Carbon;
	
	class StudentQuizAssessmentCategory extends Model
	{
		use HasFactory;
		use Uuid;
		
		public $incrementing = false;
		protected $table = 'student_quiz_assessment_categories';
		protected $keyType = 'string';
		protected $guarded = [];
		
		
		public function displayDateStartDate(): string
		{
			return Carbon::parse($this->start_date)->format('Y-m-d H:i:s');
		}
		
		public function displayDateEndDate(): string
		{
			return Carbon::parse($this->end_date)->format('Y-m-d H:i:s');
		}
		
		public function getTitle() : string {
			return ucfirst($this->title);
		}
	}
