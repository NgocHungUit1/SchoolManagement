<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class ClassSubject extends Model
{
    use HasFactory;
    protected $table = 'class_subject';
    protected $fillable = [
        'class_id',
        'subject_id',
        'status',
        'is_delete',
        'created_by'
    ];

    protected $casts = [
        'created_at' => 'date:Y-m-d',
    ];

    public function classes()
    {
        return $this->belongsTo(ClassModel::class, 'class_id'); // Mối quan hệ 1-nhiều (Belongs To) với bảng Class (Laravel sẽ tự đoán khóa ngoại là class_id)
    }

    public function subjects()
    {
        return $this->belongsTo(Subject::class, 'subject_id'); // Mối quan hệ 1-nhiều (Belongs To) với bảng Subject (Laravel sẽ tự đoán khóa ngoại là subject_id)
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by'); // Mối quan hệ 1-nhiều (Belongs To) với bảng User với khóa ngoại là created_by
    }

    public static function getRecord(array $params = [])
    {
        $return = self::with(['subjects', 'classes', 'createdBy'])
            ->where('is_delete', 0);

        if (!empty($params['class_name'])) {
            $return = $return->whereHas('classes', function ($query) use ($params) {
                $query->where('name', 'like', '%' . $params['class_name'] . '%');
            });
        }
        if (!empty($params['subject_name'])) {
            $return = $return->whereHas('subjects', function ($query) use ($params) {
                $query->where('name', 'like', '%' . $params['subject_name'] . '%');
            });
        }
        if (!empty($params['date'])) {
            $return = $return->whereDate('created_at', '=', $params['date']);
        }

        $return = $return->orderBy('class_subject.id', 'desc')->get();

        return $return;
    }

    public static function getAlreadyFirst($class_id, $subject_id)
    {
        return self::where('class_id', '=', $class_id)->where('subject_id', '=', $subject_id)->first();
    }
    public static function deleteSubject($class_id)
    {
        return self::where('class_id', '=', $class_id)->delete();
    }
    public static function getAssignSubjectId($class_id)
    {
        return self::where('class_id', '=', $class_id)->where('is_delete', '=', 0)->get();
    }

    public static function MySubject($class_id)
    {
        return self::with(['subjects' => function ($query) {
            $query->select('id', 'name', 'type');
        }, 'createdBy', 'classes'])
            ->where('class_id', '=', $class_id)
            ->where('is_delete', '=', 0)
            ->where('status', '=', 0)
            ->orderByDesc('id')
            ->get();
    }
}
