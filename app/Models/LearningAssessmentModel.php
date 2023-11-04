<?php
	
	namespace App\Models;
	
	use Carbon\Carbon;
	use Illuminate\Database\Eloquent\Model;
	use Illuminate\Database\Eloquent\Relations\BelongsTo;
	
	abstract class LearningAssessmentModel extends Model
	{
		public function displayDate() : string {
			return Carbon::parse($this->date)->format('F d, Y');
		}
		
		public function TeachingLoad(): BelongsTo
		{
			return $this->belongsTo(TeachingLoad::class);
		}
		
		
		
	}