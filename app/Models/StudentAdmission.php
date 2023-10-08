<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StudentAdmission extends Model
{
	use HasFactory;
	use Uuid;
	
	public $incrementing = false;
	protected $table = 'student_admissions';
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
	
	
	
	
	
	
}
