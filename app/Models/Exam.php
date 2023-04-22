<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $table = 'exam';

    public static function getRecord()
    {
        $return = self::select('exam.*', 'class.name as class_name', 'subject.name as subject_name', 'users.name as created_by_name')
            ->join('subject', 'subject.id', '=', 'exam.subject_id')
            ->join('class', 'class.id', '=', 'exam.class_id')
            ->join('users', 'users.id', '=', 'exam.created_by')
            ->where('exam.is_delete', '=', 0);
        $return = $return->orderBy('exam.id', 'desc')->get();
        return $return;
    }
}
