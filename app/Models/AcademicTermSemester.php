<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AcademicTermSemester extends Model
{
    use HasFactory;
    use Uuid;

    public $incrementing = false;
    protected $table = 'academic_term_semesters';
    protected $keyType = 'string';
    protected $guarded = [];

    public function AcademicTerm() : BelongsTo {
        return $this->belongsTo(AcademicTerm::class, 'academic_id', 'id');
    }

    public function getTerm() : string {
        $term = $this->AcademicTerm;
        return $term->year_from ."-". $term->year_to;
    }

    public function getSemester() : string {
        return $this->semester . ' Semester';
    }


}
