<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentQuizAssessmentAnswer extends Model
{
	use HasFactory;
	use Uuid;
	
	public $incrementing = false;
	protected $table = 'quiz_assessment_answers';
	protected $keyType = 'string';
	protected $guarded = [];
	
}
