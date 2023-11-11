<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class StudentExamAssessmentCategory extends Model
{
	use HasFactory;
	use Uuid;
	
	public $incrementing = false;
	protected $table = 'student_exam_assessment_categories';
	protected $keyType = 'string';
	protected $guarded = [];
	
	
	public function displayDateStartDate(): string
	{
		return Carbon::parse($this->start_date)->format('F m, Y H:i:s A');
	}
	
	public function displayDateEndDate(): string
	{
		return Carbon::parse($this->end_date)->format('F m, Y H:i:s A');
	}
	
	public function getTerm() : string {
		return ucfirst($this->term);
	}
	
	public function getStatus() : string {
		return $this->status == 1 ? 'Give' : 'UnGive';
	}
	
}
