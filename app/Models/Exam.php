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
        $return = self::select('exam.*', 'users.name as created_by_name')
            ->join('users', 'users.id', '=', 'exam.created_by')
            ->where('exam.is_delete', '=', 0);

        if (!empty(Request::get('exam'))) {
            $return = $return->where('exam.name', 'like', '%' . Request::get('exam') . '%');
        }
        $return = $return->orderBy('exam.id', 'desc')->get();
        return $return;
    }

    public static function getExam()
    {
        $return = self::select('exam.*', 'users.name as created_by_name')
            ->join('users', 'users.id', '=', 'exam.created_by')
            ->where('exam.is_delete', '=', 0)
            ->orderBy('exam.name', 'desc')->get();
        return $return;
    }

    public static function getStudent($id)
    {
        $return = User::select('users.*', 'users.name as student_name', 'class.name as class_name')
            ->join('class', 'class.id', '=', 'users.class_id')
            ->where('users.user_type', '=', 3)
            ->where('users.is_delete', '=', 0)
            ->where('class.status', '=', 0)
            ->where('class.id', '=', $id)
            ->orderBy('student_name', 'asc')->get();
        return $return;
    }

}
