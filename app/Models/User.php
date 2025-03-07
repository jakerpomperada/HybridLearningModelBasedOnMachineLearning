<?php
	
	namespace App\Models;
	
	// use Illuminate\Contracts\Auth\MustVerifyEmail;
	use Illuminate\Database\Eloquent\Factories\HasFactory;
	use Illuminate\Database\Eloquent\Relations\HasOne;
	use Illuminate\Foundation\Auth\User as Authenticatable;
	use Illuminate\Notifications\Notifiable;
	use Laravel\Sanctum\HasApiTokens;
	
	class User extends Authenticatable
	{
		use HasApiTokens, HasFactory, Notifiable;
		
		use Uuid;
		
		public $incrementing = false;
		protected $table = 'users';
		protected $keyType = 'string';
		protected $guarded = [];
		
		public function Student(): HasOne
		{
			return $this->hasOne(Student::class, 'user_id','id');
		}
		
	}
