<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class StudentQuizAssessmentQuestion extends Model
{
    use HasFactory;
    use Uuid;

    public $incrementing = false;
    protected $table = 'student_quiz_assessment_questions';
    protected $keyType = 'string';
    protected $guarded = [];

    public function StudentQuizAssessmentChoice(): HasMany
    {
        return $this->hasMany(StudentQuizAssessmentChoice::class, 'sqaquestion_id');
    }

    public function getCorrectAnswer(): string
    {

        foreach ($this->StudentQuizAssessmentChoice as $choice) {
            if ($choice->is_correct) return $choice->choice;
        }
        return "";

    }

    public function QuizAssessmentAnswer(): HasMany
    {
        return $this->hasMany(StudentQuizAssessmentAnswer::class,
            'quiz_assessment_question_id',
            'id');
    }

    public function isCorrect()
    {
        $result = 0;
        foreach ($this->StudentQuizAssessmentChoice as $choice) {
            if ($choice->is_correct == 1) {
               $has =  DB::table('quiz_assessment_answers')->where([
                    'quiz_assessment_question_id' => $this->id,
                    'quiz_assessment_choice_id' => $choice->id,
                ])->count();
               if ($has > 0) {
                   $result =+ 1;
               }
            }

        }

        return $result;

    }
}
