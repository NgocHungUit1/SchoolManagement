<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentScore extends Model
{
    use HasFactory;
    protected $table = 'student_score';
    public $timestamps = false;
    protected $fillable = [
        'subject_id',
        'class_id',
        'student_id',
        'score',
        'avage_score',
        'semester_id'
    ];
}
