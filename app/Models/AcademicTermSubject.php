<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AcademicTermSubject extends Model
{
    use HasFactory;
    use Uuid;

    public $incrementing = false;
    protected $table = 'academic_term_subjects';
    protected $keyType = 'string';
    protected $guarded = [];

    public function AcademicTermSemester() : BelongsTo {
        return $this->belongsTo(AcademicTermSemester::class);
    }



    public function Subject() : BelongsTo {
        return $this->belongsTo(Subject::class);
    }

    public function Course(): BelongsTo {
        return $this->belongsTo(Course::class);
    }
	
	
	public function getYearLevel(): string {
		return $this->year_level . " Year";
	}
	
	
	







}
