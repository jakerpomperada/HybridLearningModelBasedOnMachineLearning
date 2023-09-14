<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    use Uuid;

    public $incrementing = false;
    protected $table = 'students';
    protected $keyType = 'string';
    protected $guarded = [];

}
