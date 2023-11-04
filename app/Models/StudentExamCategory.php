<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentExamCategory extends LearningAssessmentModel
{
	use HasFactory;
	use Uuid;
	
	public $incrementing = false;
	protected $table = 'student_exam_categories';
	protected $keyType = 'string';
	protected $guarded = [];
}
