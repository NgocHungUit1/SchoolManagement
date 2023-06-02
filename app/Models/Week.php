<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Week extends Model
{
    use HasFactory;
    protected $table = 'day_of_week';
    protected $fillable = [
        'name',
        'fullcalendar_day'
    ];
    public static function getRecord()
    {
        return Week::get();
    }

    public function timetables()
    {
        return $this->hasMany(ClassSubjectTimetable::class);
    }
}
