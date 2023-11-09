<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentQuizAssessmentChoice extends Model
{
	use HasFactory;
	use Uuid;
	
	public $incrementing = false;
	protected $table = 'student_quiz_assessment_choices';
	protected $keyType = 'string';
	protected $guarded = [];
	
	public function letter() : string {
		return  match ($this->order) {
			1 => "A",
			2 => "B",
			3 => "C",
			4 => "D",
			default => "No letter",
		};
	}
	
}
