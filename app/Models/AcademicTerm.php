<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicTerm extends Model
{
    use HasFactory;
    use Uuid;

    public $incrementing = false;
    protected $table = 'academic_terms';
    protected $keyType = 'string';
    protected $guarded = [];

}
