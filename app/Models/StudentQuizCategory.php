<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentQuizCategory extends LearningAssessmentModel
{
	use HasFactory;
	use Uuid;
	
	public $incrementing = false;
	protected $table = 'student_quiz_categories';
	protected $keyType = 'string';
	protected $guarded = [];
	
	
	
}
