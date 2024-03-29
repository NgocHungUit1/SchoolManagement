<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Constants\Constants;


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
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function subjects()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public static function getRecord(array $params = [])
    {
        $return = self::with(['subjects', 'classes', 'createdBy'])
            ->where('is_delete', '=', Constants::IS_NOT_DELETED);

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
            ->where('is_delete', '=', Constants::IS_NOT_DELETED)
            ->where('status', '=', Constants::STATUS_ACTIVE)
            ->orderByDesc('id')
            ->get();
    }
}
