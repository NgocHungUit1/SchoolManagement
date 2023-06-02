<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class Subject extends Model
{
    use HasFactory;
    protected $table = 'subject';

    protected $fillable = [
        'name',
        'status',
        'type',
        'created_by',
        'is_delete',
    ];

    public function examScores()
    {
        return $this->hasMany(ExamScore::class);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    public function teachers()
    {
        return $this->hasMany(ClassTeacher::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function timetables()
    {
        return $this->hasMany(ClassSubjectTimetable::class);
    }
    public static function getRecord(array $params = [])
    {
        $return = Subject::with('createdBy');
        if (!empty($params['name'])) {
            $return = $return->where('subject.name', 'like', '%' . $params['name'] . '%');
        }
        if (!empty($params['type'])) {
            $return = $return->where('subject.type', 'like', '%' . $params['type']  . '%');
        }
        if (!empty($params['status'])) {
            $return = $return->where('subject.status', 'like', '%' . $params['status']  . '%');
        }

        $return = $return->where('subject.is_delete', '=', 0)->orderBy('subject.id', 'desc')->get();
        return $return;
    }



    public static function getSubject()
    {
        $return = Subject::select('subject.*')
            ->join('users', 'users.id', 'subject.created_by')
            ->where('subject.is_delete', '=', 0)
            ->where('subject.status', '=', 0)
            ->orderBy('subject.name', 'asc')->get();
        return $return;
    }
    protected $casts = [
        'created_at' => 'date:Y-m-d',
    ];
}
