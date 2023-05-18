<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Request;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'date_of_birth',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_of_birth' => 'date:Y-m-d',
        'joining_date' => 'date:Y-m-d',
        'created_at' => 'date:Y-m-d',
    ];

    public function classModel()
    {
        return $this->hasMany('App\Models\ClassModel', 'created_by', 'id');
    }

    public function subject()
    {
        return $this->hasMany('App\Models\Subject', 'created_by', 'id');
    }

    public function exam()
    {
        return $this->hasMany('App\Models\Exam', 'created_by', 'id');
    }

    public static function getUserId($id)
    {
        return self::find($id);
    }

    public static function getEmail($email)
    {
        return User::where('email', '=', $email)->first();
    }

    public static function getToken($remember_token)
    {
        return User::where('remember_token', '=', $remember_token)->first();
    }

    public static function getAdmin()
    {
        $return = self::select('users.*')->where('user_type', '=', 1)->where('is_delete', '=', 0);
        if (!empty(Request::get('name'))) {
            $return = $return->where('name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('email'))) {
            $return = $return->where('email', 'like', '%' . Request::get('email') . '%');
        }
        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('created_at', '=', Request::get('date'));
        }
        $return = $return->orderBy('id', 'desc')->get();
        return $return;
    }

    public static function getStudent()
    {
        $return = User::selectRaw('users.*, class.name as class_name')->leftJoin('class', 'class.id', '=', 'users.class_id')->where('users.user_type', '=', 3)->where('users.is_delete', '=', 0);

        if (!empty(Request::get('mobile_number'))) {
            $return = $return->where('users.mobile_number', 'like', '%' . Request::get('mobile_number') . '%');
        }
        if (!empty(Request::get('name'))) {
            $return = $return->where('users.name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('class'))) {
            $return = $return->where('class.name', 'like', '%' . Request::get('class') . '%');
        }

        $return = $return->orderBy('users.id', 'desc')->get();
        return $return;
    }

    public static function getStudentStar()
    {
        $return = User::selectRaw('users.*, class.name as class_name')->leftJoin('class', 'class.id', '=', 'users.class_id')->where('users.user_type', '=', 3)->where('users.is_delete', '=', 0);

        if (!empty(Request::get('mobile_number'))) {
            $return = $return->where('users.mobile_number', 'like', '%' . Request::get('mobile_number') . '%');
        }
        if (!empty(Request::get('name'))) {
            $return = $return->where('users.name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('class'))) {
            $return = $return->where('class.name', 'like', '%' . Request::get('class') . '%');
        }

        $return = $return->orderBy('users.id', 'desc')->take(5)->get();

        return $return;
    }

    public static function getTeacher()
    {
        $return = User::selectRaw('users.*, subject.name as subject_name')->leftJoin('subject', 'subject.id', '=', 'users.subject_id')->where('users.user_type', '=', 2)->where('users.is_delete', '=', 0);

        if (!empty(Request::get('mobile_number'))) {
            $return = $return->where('users.mobile_number', 'like', '%' . Request::get('mobile_number') . '%');
        }
        if (!empty(Request::get('name'))) {
            $return = $return->where('users.name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('address'))) {
            $return = $return->where('users.address', 'like', '%' . Request::get('address') . '%');
        }
        $return = $return->orderBy('users.id', 'desc')->get();
        return $return;
    }

    public static function getStudentTeacher($teacher_id)
    {

        $return = self::select('users.*', 'class.name as class_name')
            ->join('class', 'class.id', '=', 'users.class_id')
            ->join('teacher_class', 'teacher_class.class_id', '=', 'class.id')
            ->where('teacher_class.teacher_id', '=', $teacher_id)
            ->where('teacher_class.is_delete', '=', 0)
            ->where('teacher_class.status', '=', 0)
            ->where('users.user_type', '=', 3)
            ->where('users.is_delete', '=', 0);
        $return = $return->orderBy('users.id', 'desc')->groupBy('users.id')
            ->get();
        return $return;
    }

    public static function getStudentClass()
    {
        $return = self::select('users.*')
            ->join('class', 'class.id', '=', 'users.class_id')
            ->join('exam', 'exam.class_id', '=', 'class.id')
            ->where('users.user_type', '=', 3)
            ->where('users.is_delete', '=', 0);
        $return = $return->orderBy('users.id', 'desc')->groupBy('users.id')
            ->get();
        return $return;
    }

    public static function getStudentClassExam($class_id)
    {
        return self::select('users.id','users.name')
            ->where('users.user_type', '=', 3)
            ->where('users.is_delete', '=', 0)
            ->where('users.class_id', '=', $class_id)
            ->orderBy('users.id', 'desc')
            ->get();
    }

    public static function SubjectTeacher($subject_id)
    {
        $return = User::select('users.*', 'users.name as teacher_name')
            ->join('subject', 'subject.id', '=', 'users.subject_id')
            ->where('users.subject_id', '=', $subject_id)
            ->where('users.is_delete', '=', 0)
            ->where('users.status', '=', 0)
            ->orderBy('users.id', 'desc')
            ->get();
         return $return;
    }

}
