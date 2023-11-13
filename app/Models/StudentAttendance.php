<?php
	
	namespace App\Models;
	
	use Illuminate\Database\Eloquent\Factories\HasFactory;
	use Illuminate\Database\Eloquent\Model;
	use Illuminate\Database\Eloquent\Relations\BelongsTo;
	use Illuminate\Support\Collection;
	
	class StudentAttendance extends Model
	{
		use HasFactory;
		use Uuid;
		
		public $incrementing = false;
		protected $table = 'student_attendances';
		protected $keyType = 'string';
		protected $guarded = [];
		
		
		public function Admission(): BelongsTo
		{
			return $this->belongsTo(Admission::class);
		}
		
		public function TeachingLoad(): BelongsTo
		{
			return $this->belongsTo(TeachingLoad::class);
		}
		
		public function countPresent(Collection $status_data): int
		{
			$count = 0;
			
			foreach ($status_data as $data) {
				if ($data->status == 'present') {
					$count++;
				}
			}
			
			return $count;
		}
		
		public function countAbsent(Collection $status_data): int
		{
			$count = 0;
			
			foreach ($status_data as $data) {
				if ($data->status == 'absent') {
					$count++;
				}
			}
			
			return $count;
		}
		
		public function countExcuse(Collection $status_data): int
		{
			$count = 0;
			
			foreach ($status_data as $data) {
				if ($data->status == 'excuse') {
					$count++;
				}
			}
			
			return $count;
		}
		
		public function isChecked(string $value): string  {
			return $this->status == $value ? 'checked' : '';
		}
		
	}
