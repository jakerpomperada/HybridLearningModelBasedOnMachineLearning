<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudentQuizAssessmentQuestion extends Model
{
	use HasFactory;
	use Uuid;
	
	public $incrementing = false;
	protected $table = 'student_quiz_assessment_questions';
	protected $keyType = 'string';
	protected $guarded = [];
	
	public function StudentQuizAssessmentChoice() : HasMany {
		return $this->hasMany(StudentQuizAssessmentChoice::class, 'sqaquestion_id');
	}
	
	public function getCorrectAnswer() : string {
		
		foreach ($this->StudentQuizAssessmentChoice as $choice) {
			if ($choice->is_correct) return $choice->choice;
		}
		return "";
		
	}
}
