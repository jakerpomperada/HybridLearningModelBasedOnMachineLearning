<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentTaskPerformanceCategory extends Model
{
	use HasFactory;
	use Uuid;
	
	public $incrementing = false;
	protected $table = 'student_task_performance_categories';
	protected $keyType = 'string';
	protected $guarded = [];
	
	public function TeachingLoad(): BelongsTo
	{
		return $this->belongsTo(TeachingLoad::class);
	}
	
	public function displayDate() : string {
		return Carbon::parse($this->date)->format('F d, Y');
	}
}
