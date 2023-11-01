<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentQuiz extends Model
{
	use HasFactory;
	use Uuid;
	
	public $incrementing = false;
	protected $table = 'student_quizzes';
	protected $keyType = 'string';
	protected $guarded = [];
}
