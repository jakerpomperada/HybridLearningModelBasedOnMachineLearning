<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Admission extends Model
{
	use HasFactory;
	use Uuid;
	
	public $incrementing = false;
	protected $table = 'admissions';
	protected $keyType = 'string';
	protected $guarded = [];
	
	
	public function Student() : BelongsTo {
		return $this->belongsTo(Student::class);
	}
	
	
	public function Course() : BelongsTo {
		return $this->belongsTo(Course::class);
	}
	
	
	public function AcademicTerm(): BelongsTo {
		return $this->belongsTo(
			AcademicTerm::class,
			'academic_term_id',
			'id'
		);
	}
	
	public function AcademicTermSemester(): BelongsTo {
		return $this->belongsTo(
			AcademicTermSemester::class,
			'academic_term_semester_id',
			'id'
		);
	}
	
	
	
	
	
	
}
