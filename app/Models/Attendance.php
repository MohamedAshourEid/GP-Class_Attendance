<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table="attendance";
    protected $fillable=['course_id','student_id','session_id'];

    public $timestamps=false;

}
