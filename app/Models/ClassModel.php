<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Request;

class ClassModel extends Model
{
    use HasFactory;
    protected $table = 'class';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function getClassId($id)
    {
        return self::find($id);
    }

    public static function getClass()
    {
        $return = ClassModel::select('class.*')
            ->join('users', 'users.id', 'class.created_by')
            ->where('class.is_delete', '=', 0)
            ->where('class.status', '=', 0)
            ->orderBy('class.name', 'asc')->get();
        return $return;
    }

    public static function getRecord()
    {
        $return = ClassModel::select('class.*', 'users.name as created_by_name')->join('users', 'users.id', 'class.created_by');
        if (!empty(Request::get('name'))) {
            $return = $return->where('class.name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('type'))) {
            $return = $return->where('class.type', 'like', '%' . Request::get('type') . '%');
        }
        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('class.created_at', '=', Request::get('date'));
        }

        $return = $return->where('class.is_delete', '=', 0)->orderBy('class.id', 'desc')->get();
        return $return;
    }

}
