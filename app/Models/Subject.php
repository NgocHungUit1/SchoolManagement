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

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    public static function getRecord()
    {
        $return = Subject::select('subject.*', 'users.name as created_by_name')->join('users', 'users.id', 'subject.created_by');
        if (!empty(Request::get('name'))) {
            $return = $return->where('subject.name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('type'))) {
            $return = $return->where('subject.type', 'like', '%' . Request::get('type') . '%');
        }
        if (!empty(Request::get('status'))) {
            $return = $return->where('subject.status', 'like', '%' . Request::get('status') . '%');
        }

        $return = $return->where('subject.is_delete', '=', 0)->orderBy('subject.id', 'desc')->get();
        return $return;
    }
    public static function getSubjectId($id)
    {
        return self::find($id);
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
