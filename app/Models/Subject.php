<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    use Uuid;

    public $incrementing = false;
    protected $table = 'subjects';
    protected $keyType = 'string';
    protected $guarded = [];
}
