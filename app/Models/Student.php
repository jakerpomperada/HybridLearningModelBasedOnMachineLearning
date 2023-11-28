<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;
    use Uuid;

    public $incrementing = false;
    protected $table = 'students';
    protected $keyType = 'string';
    protected $guarded = [];

    public function User() : BelongsTo {
        return $this->belongsTo(User::class);
    }

	public function completeName() : string {
		return $this->lastname ." ". $this->firstname;
	}


}
