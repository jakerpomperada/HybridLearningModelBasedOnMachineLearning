<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudentExamAssessmentQuestion extends Model
{
	use HasFactory;
	use Uuid;
	
	public $incrementing = false;
	protected $table = 'student_exam_assessment_questions';
	protected $keyType = 'string';
	protected $guarded = [];
	
	public function StudentExamAssessmentChoice() : HasMany {
		return $this->hasMany(StudentExamAssessmentChoice::class, 'seaquestion_id');
	}
	
	public function getCorrectAnswer() : string {
		
		foreach ($this->StudentExamAssessmentChoice as $choice) {
			if ($choice->is_correct) return $choice->choice;
		}
		return "";
		
	}
	
}
