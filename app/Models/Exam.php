<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class Exam extends Model
{
    use HasFactory;
    protected $table = 'exam';
    protected $casts = [
        'created_at' => 'date:d-m-Y',
    ];

    public static function getRecord()
    {
        $return = self::select('exam.*', 'class.name as class_name', 'subject.name as subject_name', 'users.name as created_by_name')
            ->join('subject', 'subject.id', '=', 'exam.subject_id')
            ->join('class', 'class.id', '=', 'exam.class_id')
            ->join('users', 'users.id', '=', 'exam.created_by')
            ->where('exam.is_delete', '=', 0);

        if (!empty(Request::get('class'))) {
            $return = $return->where('class.name', 'like', '%' . Request::get('class') . '%');
        }
        if (!empty(Request::get('subject'))) {
            $return = $return->where('subject.name', 'like', '%' . Request::get('subject') . '%');
        }
        if (!empty(Request::get('exam'))) {
            $return = $return->where('exam.name', 'like', '%' . Request::get('exam') . '%');
        }
        $return = $return->orderBy('exam.id', 'desc')->get();
        return $return;
    }

}
