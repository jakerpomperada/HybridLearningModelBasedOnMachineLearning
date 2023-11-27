<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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

    public function StudentQuizAssessmentQuestion(): HasMany
    {
        return $this->hasMany(StudentQuizAssessmentQuestion::class, 'qacategory_id', 'id');
    }


    public function displayDateEndDate(): string
    {
        return Carbon::parse($this->end_date)->format('Y-m-d H:i:s');
    }

    public function getTitle(): string
    {
        return ucfirst($this->title);
    }

    public function getStatus(): string
    {
        return $this->status == 'give' ? 'UnGive' : 'Give';
    }

    public function getStatusLink(string $teaching_load_id): string
    {
        if ($this->status == 'give') {
            return 'quiz-status-ungive/' . $this->id . '?teaching_load_id=' . $teaching_load_id;
        }
        return 'quiz-status-give/' . $this->id . '?teaching_load_id=' . $teaching_load_id;
    }

    public function getTotalItems(): int
    {
        return $this->StudentQuizAssessmentQuestion->count();
    }

    public function getStudentScores(string $student_id): int
    {
        $questions = $this->StudentQuizAssessmentQuestion;
        $result = [];
        foreach ($questions as $question) {
            $result[] = $question->isCorrect();
        }

        return array_sum($result);
    }

    public function isAlreadyTaken(string $student_id): string
    {

        $exists = DB::table('student_quiz_assessment_statuses')->where([
            'sqac_id' => $this->id,
            'student_id' => $student_id,
        ])->exists();

        return (bool)$exists;
    }

    public function StudentQuizAssessmentStatus(): HasOne
    {
        return $this->hasOne(StudentQuizAssessmentStatus::class);
    }

}
