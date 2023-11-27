<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentQuizAssessmentStatus extends Model
{
    use HasFactory;
    use Uuid;

    public $incrementing = false;
    protected $table = 'student_quiz_assessment_statuses';
    protected $keyType = 'string';
    protected $guarded = [];
}
