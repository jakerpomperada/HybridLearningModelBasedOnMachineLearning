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
		
		public function getTitle(): string
		{
			return ucfirst($this->title);
		}
		
		public function getStatus() : string {
			return $this->status == 'give' ? 'UnGive' : 'Give';
		}
		
		public function getStatusLink(string $teaching_load_id) : string {
			if ($this->status == 'give') {
				return 'quiz-status-ungive/' . $this->id.'?teaching_load_id='.$teaching_load_id;
			}
			return 'quiz-status-give/' . $this->id.'?teaching_load_id='.$teaching_load_id;
		}
		
	}
