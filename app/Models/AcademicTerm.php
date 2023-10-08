<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AcademicTerm extends Model
{
    use HasFactory;
    use Uuid;

    public $incrementing = false;
    protected $table = 'academic_terms';
    protected $keyType = 'string';
    protected $guarded = [];
	
	public function AcademicTermSemesters(): HasMany {
		return $this->hasMany(
			AcademicTermSemester::class,
			'academic_term_semester_id',
			'id'
		);
	}
	

}
