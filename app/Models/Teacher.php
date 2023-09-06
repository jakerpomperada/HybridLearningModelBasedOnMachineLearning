<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    use Uuid;

    public $incrementing = false;
    protected $table = 'teachers';
    protected $keyType = 'string';
    protected $guarded = [];
}
