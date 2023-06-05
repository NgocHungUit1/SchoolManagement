<?php

namespace App\Models;

use App\Constants\Constants;
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
        'admission_number',
        'roll_number',
        'class_id',
        'teacher_id',
        'subject_id',
        'joining_date',
        'qualification',
        'experience',
        'gender',
        'address',
        'date_of_birth',
        'mobile_number',
        'status',
        'password',
        'email',
        'user_type',
        'user_avatar'
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

    public function classes()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }


    public function subjects()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function exam()
    {
        return $this->hasMany('App\Models\Exam', 'created_by', 'id');
    }

    public function studentScoresSemester()
    {
        return $this->hasMany(StudentScoreSemester::class, 'student_id');
    }

    public function examScoresSemester()
    {
        return $this->hasMany(ExamScore::class, 'student_id');
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
        $return = self::select('users.*')->where('user_type', '=', Constants::ADMIN)
            ->where('is_delete',  Constants::IS_NOT_DELETED);
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

    public static function getStudents($id)
    {
        $return = User::select('users.*', 'users.name as student_name')
            ->where('users.user_type', '=', Constants::STUDENT)
            ->where('users.is_delete', '=',  Constants::IS_NOT_DELETED)
            ->whereHas('classes', function ($query) {
                $query->where('status', '=', 0);
            })
            ->whereHas('classes', function ($query) use ($id) {
                $query->where('id', '=', $id);
            })
            ->orderBy('student_name', 'asc')->get();
        return $return;
    }


    public static function getStudent(array $params = [])
    {
        $return = self::with('classes')
            ->where('users.user_type', '=', Constants::STUDENT)
            ->where('users.is_delete', '=',  Constants::IS_NOT_DELETED);

        if (!empty($params['mobile_number'])) {
            $return = $return->where('users.mobile_number', 'like', '%' . $params['mobile_number']  . '%');
        }
        if (!empty($params['name'])) {
            $return = $return->where('users.name', 'like', '%' . $params['name'] . '%');
        }
        if (!empty($params['class'])) {
            $return = $return->whereHas('classes', function ($query) use ($params) {
                $query->where('name', 'like', '%' . $params['class'] . '%');
            });
        }

        $return = $return->orderBy('users.id', 'desc')->get();
        return $return;
    }

    public static function getTeacher(array $params = [])
    {
        $return = self::with('subjects')
            ->where('users.user_type', '=', Constants::TEACHER)
            ->where('users.is_delete', '=',  Constants::IS_NOT_DELETED);

        if (!empty($params['mobile_number'])) {
            $return = $return->where('users.mobile_number', 'like', '%' . $params['mobile_number']  . '%');
        }
        if (!empty($params['name'])) {
            $return = $return->where('users.name', 'like', '%' . $params['name'] . '%');
        }
        if (!empty($params['address'])) {
            $return = $return->where('users.address', 'like', '%' . $params['address'] . '%');
        }

        $return = $return->orderBy('users.id', 'desc')->get();
        return $return;
    }

    public static function getStudentClassExam($id)
    {
        return self::with(['examScoresSemester', 'studentScoresSemester'])->select('users.id', 'users.name')
            ->where('users.user_type', '=', Constants::STUDENT)
            ->where('users.is_delete', '=',  Constants::IS_NOT_DELETED)
            ->where('users.class_id', '=', $id)
            ->orderBy('users.id', 'desc')
            ->get();
    }

    public static function getStudentClassScore($id)
    {
        return self::select('users.id', 'users.name', 'users.score')
            ->where('users.user_type', '=', Constants::STUDENT)
            ->where('users.is_delete', '=',  Constants::IS_NOT_DELETED)
            ->where('users.class_id', '=', $id)
            ->orderBy('users.score', 'desc')
            ->get();
    }

    public static function SubjectTeacher($subject_id)
    {
        $return = User::select('users.*', 'users.name as teacher_name')
            ->join('subject', 'subject.id', '=', 'users.subject_id')
            ->where('users.subject_id', '=', $subject_id)
            ->where('users.is_delete', '=',  Constants::IS_NOT_DELETED)
            ->where('users.status', '=', Constants::STATUS_ACTIVE)
            ->orderBy('users.id', 'desc')
            ->get();
        return $return;
    }


    public static function getStudentStar()
    {
        $return = User::selectRaw('users.*, class.name as class_name,student_score_average.avage_score as score')
            ->leftJoin('class', 'class.id', '=', 'users.class_id')
            ->join('student_score_average', 'student_score_average.student_id', '=', 'users.id')
            ->where('student_score_average.semester_id', '=', 3)
            ->where('users.user_type', '=', Constants::STUDENT)
            ->where('users.is_delete', '=',  Constants::IS_NOT_DELETED);
        $return = $return->orderBy('student_score_average.avage_score', 'desc')->limit(5)->get();

        return $return;
    }
}
