<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrolled_Courses extends Model
{
    protected $table = "enrolled_courses";
    protected $fillable = ['id','student_id','course_id'];

    public $timestamps=false;
}
