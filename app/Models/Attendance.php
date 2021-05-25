<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table="attendance";
    protected $fillable=['id','course_id','session_id','student_id','attended'];

    public $timestamps=false;

}
