<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudentParticipationCategory extends Model
{
	use HasFactory;
	use Uuid;
	
	public $incrementing = false;
	protected $table = 'student_participation_categories';
	protected $keyType = 'string';
	protected $guarded = [];
	
	public function TeachingLoad(): BelongsTo
	{
		return $this->belongsTo(TeachingLoad::class);
	}
	
	public function getYearSection() : string {
		return "";
	}
	
	
	
}
