<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    use HasFactory;
    use Uuid;

    public $incrementing = false;
    protected $table = 'courses';
    protected $keyType = 'string';
    protected $guarded = [];
	
	public function getCode(): string {
		return $this->code;
	}


}
