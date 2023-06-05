<?php

namespace App\Models;

use App\Constants\Constants;
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

    protected $fillable = [
        'name',
        'description',
        'created_by',
        'is_delete',
    ];


    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public static function getRecord($exam_name = '')
    {
        $query = self::with('createdBy')
            ->where('is_delete',  Constants::IS_NOT_DELETED);

        if (!empty($exam_name)) {
            $query = $query->where('name', 'like', '%' . $exam_name . '%');
        }

        return $query->orderBy('id', 'desc')->get();
    }


    public static function getExam()
    {
        $return = self::with('createdBy')
            ->where('is_delete',  Constants::IS_NOT_DELETED)
            ->where('exam.is_delete', '=', 0)
            ->orderBy('exam.name', 'asc')->get();
        return $return;
    }

    public static function getExamsByIds($examIds)
    {
        return self::whereIn('id', $examIds)->get();
    }
}
