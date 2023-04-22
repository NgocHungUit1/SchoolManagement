<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Week extends Model
{
    use HasFactory;
    protected $table = 'day_of_week';
    public static function getRecord()
    {
        return Week::get();
    }
}
